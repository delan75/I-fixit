<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\DamagedPart;
use App\Models\Labor;
use App\Models\Painting;
use App\Models\Part;
use App\Models\Report;
use App\Models\ReportType;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;
use App\Services\ActivityLogService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all report types
        $reportTypes = ReportType::active()->get();

        // Get user's recent reports
        $recentReports = Auth::user()->reports()
            ->with('reportType')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Log reports index view activity
        ActivityLogService::log(
            'view_reports_index',
            "Viewed reports index page",
            null,
            ['report_count' => $recentReports->count()],
            Auth::id()
        );

        return view('reports.index', compact('reportTypes', 'recentReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $reportTypeId = $request->query('type');
        $reportType = ReportType::findOrFail($reportTypeId);

        // Get data for filter options
        $makes = Car::select('make')->distinct()->pluck('make');
        $years = Car::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $phases = ['bidding', 'fixing', 'dealership', 'sold'];

        // Date ranges
        $dateRanges = [
            'last_30_days' => 'Last 30 Days',
            'last_90_days' => 'Last 90 Days',
            'last_6_months' => 'Last 6 Months',
            'last_year' => 'Last Year',
            'all_time' => 'All Time',
            'custom' => 'Custom Range',
        ];

        // Get users for admin/superuser
        $users = [];
        if (Auth::user()->hasAdminAccess()) {
            $users = User::where('id', '!=', Auth::id())->get(['id', 'name', 'email']);
        }

        // Get cars based on user role
        $cars = [];
        if (Auth::user()->hasAdminAccess()) {
            // Admins and superusers can see all cars
            $cars = Car::with(['sale'])->get();
        } else {
            // Regular users can only see their own cars
            $cars = Car::where('user_id', Auth::id())->with(['sale'])->get();
        }

        // Log report creation form view activity
        ActivityLogService::log(
            'view_report_form',
            "Viewed report creation form for type: {$reportType->name}",
            $reportType,
            null,
            Auth::id()
        );

        return view('reports.create', compact('reportType', 'makes', 'years', 'phases', 'dateRanges', 'users', 'cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'report_type_id' => 'required|exists:report_types,id',
            'title' => 'required|string|max:255',
            'date_range' => 'required|string',
            'start_date' => 'required_if:date_range,custom|nullable|date',
            'end_date' => 'required_if:date_range,custom|nullable|date|after_or_equal:start_date',
            'make' => 'nullable|string',
            'model' => 'nullable|string',
            'year' => 'nullable|integer',
            'phase' => 'nullable|string|in:bidding,fixing,dealership,sold',
            'selected_cars' => 'nullable|array',
            'selected_cars.*' => 'exists:cars,id',
            'selected_user_id' => 'nullable|exists:users,id',
        ]);

        // Process date range
        $startDate = null;
        $endDate = Carbon::now();

        switch ($validated['date_range']) {
            case 'last_30_days':
                $startDate = Carbon::now()->subDays(30);
                break;
            case 'last_90_days':
                $startDate = Carbon::now()->subDays(90);
                break;
            case 'last_6_months':
                $startDate = Carbon::now()->subMonths(6);
                break;
            case 'last_year':
                $startDate = Carbon::now()->subYear();
                break;
            case 'all_time':
                $startDate = null;
                break;
            case 'custom':
                $startDate = Carbon::parse($validated['start_date']);
                $endDate = Carbon::parse($validated['end_date'])->endOfDay();
                break;
        }

        // Generate report data based on report type
        $reportType = ReportType::findOrFail($validated['report_type_id']);

        // Build the base query
        $carsQuery = Car::query();

        // Apply specific car selection if provided
        if (!empty($validated['selected_cars'])) {
            $carsQuery->whereIn('id', $validated['selected_cars']);
        } else {
            // Apply date filters if provided
            if ($startDate) {
                $carsQuery->where('created_at', '>=', $startDate);
            }

            if ($endDate) {
                $carsQuery->where('created_at', '<=', $endDate);
            }

            // Apply other filters if provided
            if (!empty($validated['make'])) {
                $carsQuery->where('make', $validated['make']);
            }

            if (!empty($validated['model'])) {
                $carsQuery->where('model', $validated['model']);
            }

            if (!empty($validated['year'])) {
                $carsQuery->where('year', $validated['year']);
            }

            if (!empty($validated['phase'])) {
                $carsQuery->where('current_phase', $validated['phase']);
            }

            // If admin/superuser is generating report for a specific user
            if (Auth::user()->hasAdminAccess() && !empty($validated['selected_user_id'])) {
                $carsQuery->where('user_id', $validated['selected_user_id']);
            } else if (!Auth::user()->hasAdminAccess()) {
                // Regular users can only generate reports for their own cars
                $carsQuery->where('user_id', Auth::id());
            }
        }

        // Generate the report data
        $reportData = $this->generateReportData($reportType, $carsQuery);

        // Create the report
        $report = new Report();
        $report->report_type_id = $validated['report_type_id'];
        $report->user_id = Auth::id();
        $report->title = $validated['title'];

        // Store all filters including selected cars and user
        $filters = $request->only(['date_range', 'start_date', 'end_date', 'make', 'model', 'year', 'phase']);

        if (!empty($validated['selected_cars'])) {
            $filters['selected_cars'] = $validated['selected_cars'];

            // Get car details for reference
            $selectedCars = Car::whereIn('id', $validated['selected_cars'])
                ->get(['id', 'make', 'model', 'year', 'color'])
                ->map(function($car) {
                    return [
                        'id' => $car->id,
                        'name' => "{$car->year} {$car->make} {$car->model} {$car->color}"
                    ];
                })
                ->pluck('name', 'id')
                ->toArray();

            $filters['selected_car_details'] = $selectedCars;
        }

        if (!empty($validated['selected_user_id'])) {
            $filters['selected_user_id'] = $validated['selected_user_id'];

            // Get user details for reference
            $user = User::find($validated['selected_user_id']);
            if ($user) {
                $filters['selected_user_name'] = $user->name;
            }
        }

        $report->filters = $filters;
        $report->data = $reportData;
        $report->generated_at = now();
        $report->save();

        // Log report generation activity
        ActivityLogService::log(
            'generate_report',
            "Generated report: {$report->title} (Type: {$report->reportType->name})",
            $report,
            ['report_type' => $report->reportType->name],
            Auth::id()
        );

        return redirect()->route('reports.show', $report)
            ->with('success', 'Report generated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        // Check if user has permission to view this report
        if ($report->user_id !== Auth::id() && !Auth::user()->hasAdminAccess()) {
            abort(403, 'Unauthorized action.');
        }

        // Log report view activity
        ActivityLogService::log(
            'view_report',
            "Viewed report: {$report->title} (Type: {$report->reportType->name})",
            $report,
            ['report_type' => $report->reportType->name],
            Auth::id()
        );

        return view('reports.show', compact('report'));
    }

    /**
     * Export the report to PDF.
     */
    public function exportPdf(Report $report)
    {
        // Check if user has permission to view this report
        if ($report->user_id !== Auth::id() && !Auth::user()->hasAdminAccess()) {
            abort(403, 'Unauthorized action.');
        }

        // Generate PDF based on report type
        $pdf = \PDF::loadView('reports.pdf.' . $report->reportType->slug, [
            'report' => $report,
            'data' => $report->data,
        ]);

        // Set PDF options
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif',
        ]);

        // Generate filename
        $filename = Str::slug($report->title) . '-' . date('Y-m-d') . '.pdf';

        // Update report with file information
        $report->file_path = 'reports/' . $filename;
        $report->file_type = 'pdf';
        $report->save();

        // Log PDF export activity
        ActivityLogService::log(
            'export_report',
            "Exported report to PDF: {$report->title} (Type: {$report->reportType->name})",
            $report,
            ['format' => 'pdf', 'report_type' => $report->reportType->name],
            Auth::id()
        );

        // Return the PDF as a download
        return $pdf->download($filename);
    }

    /**
     * Export the report to Excel/CSV.
     */
    public function exportExcel(Report $report, Request $request)
    {
        // Check if user has permission to view this report
        if ($report->user_id !== Auth::id() && !Auth::user()->hasAdminAccess()) {
            abort(403, 'Unauthorized action.');
        }

        $format = $request->query('format', 'xlsx');

        // Create the export class based on report type
        $export = new \App\Exports\ReportExport($report);

        // Generate filename
        $filename = Str::slug($report->title) . '-' . date('Y-m-d');

        // Update report with file information
        $report->file_path = 'reports/' . $filename . '.' . $format;
        $report->file_type = $format;
        $report->save();

        // Log Excel/CSV export activity
        ActivityLogService::log(
            'export_report',
            "Exported report to {$format}: {$report->title} (Type: {$report->reportType->name})",
            $report,
            ['format' => $format, 'report_type' => $report->reportType->name],
            Auth::id()
        );

        // Return the Excel/CSV file as a download
        if ($format === 'csv') {
            return \Maatwebsite\Excel\Facades\Excel::download($export, $filename . '.csv', \Maatwebsite\Excel\Excel::CSV);
        } else {
            return \Maatwebsite\Excel\Facades\Excel::download($export, $filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        // Check if user has permission to delete this report
        if ($report->user_id !== Auth::id() && !Auth::user()->hasAdminAccess()) {
            abort(403, 'Unauthorized action.');
        }

        // Store report details before deletion for logging
        $reportTitle = $report->title;
        $reportType = $report->reportType->name;
        $reportId = $report->id;

        $report->delete();

        // Log report deletion activity
        ActivityLogService::log(
            'delete_report',
            "Deleted report: {$reportTitle} (Type: {$reportType})",
            null,
            [
                'report_id' => $reportId,
                'report_title' => $reportTitle,
                'report_type' => $reportType
            ],
            Auth::id()
        );

        return redirect()->route('reports.index')
            ->with('success', 'Report deleted successfully.');
    }

    /**
     * Generate report data based on report type and car query.
     */
    private function generateReportData(ReportType $reportType, $carsQuery)
    {
        $data = [];

        // Generate different report data based on report type
        switch ($reportType->slug) {
            case 'profitability-analysis':
                $data = $this->generateProfitabilityReport($carsQuery);
                break;

            case 'repair-cost-analysis':
                $data = $this->generateRepairCostReport($carsQuery);
                break;

            case 'sales-performance':
                $data = $this->generateSalesPerformanceReport($carsQuery);
                break;

            case 'time-at-dealership':
                $data = $this->generateTimeAtDealershipReport($carsQuery);
                break;

            case 'investment-summary':
                $data = $this->generateInvestmentSummaryReport($carsQuery);
                break;

            default:
                $data = ['error' => 'Unknown report type'];
        }

        return $data;
    }

    /**
     * Generate profitability analysis report.
     */
    private function generateProfitabilityReport($carsQuery)
    {
        // Get cars with sales data
        $cars = $carsQuery->with(['sale'])->whereHas('sale')->get();

        // Group by make
        $profitByMake = $cars->groupBy('make')->map(function ($carGroup) {
            $totalProfit = $carGroup->sum(function ($car) {
                $sellingPrice = $car->sale ? $car->sale->selling_price : 0;
                return $sellingPrice - $car->getTotalInvestmentAttribute();
            });

            $avgProfit = $carGroup->count() > 0 ? $totalProfit / $carGroup->count() : 0;

            return [
                'count' => $carGroup->count(),
                'total_profit' => $totalProfit,
                'avg_profit' => $avgProfit,
                'avg_roi' => $carGroup->avg(function ($car) {
                    return $car->getRoiPercentageAttribute() ?? 0;
                }),
            ];
        });

        // Group by year
        $profitByYear = $cars->groupBy('year')->map(function ($carGroup) {
            $totalProfit = $carGroup->sum(function ($car) {
                $sellingPrice = $car->sale ? $car->sale->selling_price : 0;
                return $sellingPrice - $car->getTotalInvestmentAttribute();
            });

            return [
                'count' => $carGroup->count(),
                'total_profit' => $totalProfit,
                'avg_profit' => $carGroup->count() > 0 ? $totalProfit / $carGroup->count() : 0,
            ];
        })->sortKeys();

        return [
            'by_make' => $profitByMake->toArray(),
            'by_year' => $profitByYear->toArray(),
            'total_cars' => $cars->count(),
            'total_profit' => $cars->sum(function ($car) {
                $sellingPrice = $car->sale ? $car->sale->selling_price : 0;
                return $sellingPrice - $car->getTotalInvestmentAttribute();
            }),
            'avg_profit' => $cars->count() > 0 ? $cars->sum(function ($car) {
                $sellingPrice = $car->sale ? $car->sale->selling_price : 0;
                return $sellingPrice - $car->getTotalInvestmentAttribute();
            }) / $cars->count() : 0,
            'avg_roi' => $cars->avg(function ($car) {
                return $car->getRoiPercentageAttribute() ?? 0;
            }),
        ];
    }

    /**
     * Generate repair cost analysis report.
     */
    private function generateRepairCostReport($carsQuery)
    {
        // Get cars with repair data
        $cars = $carsQuery->with(['parts', 'laborEntries', 'paintingEntries', 'damagedParts'])->get();

        // Calculate repair costs by category
        $partsCost = $cars->sum(function ($car) {
            return $car->parts->sum('total_price');
        });

        $laborCost = $cars->sum(function ($car) {
            return $car->laborEntries->sum('total_cost');
        });

        $paintingCost = $cars->sum(function ($car) {
            return $car->paintingEntries->sum('total_cost');
        });

        // Calculate estimated vs actual repair costs
        $estimatedRepairCost = $cars->sum('estimated_repair_cost');
        $actualRepairCost = $partsCost + $laborCost + $paintingCost;

        // Get most common damaged parts
        $damagedParts = DamagedPart::whereIn('car_id', $cars->pluck('id'))
            ->select('part_name', DB::raw('count(*) as count'))
            ->groupBy('part_name')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        return [
            'cost_by_category' => [
                'parts' => $partsCost,
                'labor' => $laborCost,
                'painting' => $paintingCost,
            ],
            'estimated_vs_actual' => [
                'estimated' => $estimatedRepairCost,
                'actual' => $actualRepairCost,
                'difference' => $actualRepairCost - $estimatedRepairCost,
                'percentage_difference' => $estimatedRepairCost > 0 ?
                    (($actualRepairCost - $estimatedRepairCost) / $estimatedRepairCost) * 100 : 0,
            ],
            'common_damaged_parts' => $damagedParts->toArray(),
            'total_cars' => $cars->count(),
            'avg_repair_cost' => $cars->count() > 0 ? $actualRepairCost / $cars->count() : 0,
        ];
    }

    /**
     * Generate sales performance report.
     */
    private function generateSalesPerformanceReport($carsQuery)
    {
        // Get cars with sales data
        $cars = $carsQuery->with(['sale'])->whereHas('sale')->get();

        // Group sales by month
        $salesByMonth = $cars->groupBy(function ($car) {
            return Carbon::parse($car->sale->sale_date)->format('Y-m');
        })->map(function ($carGroup) {
            return [
                'count' => $carGroup->count(),
                'total_revenue' => $carGroup->sum(function ($car) {
                    return $car->sale ? $car->sale->selling_price : 0;
                }),
                'avg_price' => $carGroup->count() > 0 ?
                    $carGroup->sum(function ($car) {
                        return $car->sale ? $car->sale->selling_price : 0;
                    }) / $carGroup->count() : 0,
            ];
        })->sortKeys();

        // Calculate average time to sell
        $avgTimeToSell = $cars->avg(function ($car) {
            if ($car->dealership_date && $car->sale && $car->sale->sale_date) {
                return Carbon::parse($car->dealership_date)->diffInDays(Carbon::parse($car->sale->sale_date));
            }
            return null;
        });

        return [
            'by_month' => $salesByMonth->toArray(),
            'total_cars_sold' => $cars->count(),
            'total_revenue' => $cars->sum(function ($car) {
                return $car->sale ? $car->sale->selling_price : 0;
            }),
            'avg_selling_price' => $cars->count() > 0 ?
                $cars->sum(function ($car) {
                    return $car->sale ? $car->sale->selling_price : 0;
                }) / $cars->count() : 0,
            'avg_time_to_sell' => $avgTimeToSell,
        ];
    }

    /**
     * Generate time at dealership report.
     */
    private function generateTimeAtDealershipReport($carsQuery)
    {
        // Get cars in dealership phase or sold
        $cars = $carsQuery->whereIn('current_phase', ['dealership', 'sold'])
            ->whereNotNull('dealership_date')
            ->with(['sale'])
            ->get();

        // Calculate days at dealership for each car
        $carsWithDays = $cars->map(function ($car) {
            $startDate = Carbon::parse($car->dealership_date);
            $endDate = $car->current_phase === 'sold' && $car->sale && $car->sale->sale_date ?
                Carbon::parse($car->sale->sale_date) : Carbon::now();

            $daysAtDealership = $startDate->diffInDays($endDate);

            return [
                'id' => $car->id,
                'make' => $car->make,
                'model' => $car->model,
                'year' => $car->year,
                'days_at_dealership' => $daysAtDealership,
                'is_sold' => $car->current_phase === 'sold',
            ];
        });

        // Group by days range
        $dayRanges = [
            '0-30' => $carsWithDays->filter(function ($car) {
                return $car['days_at_dealership'] <= 30;
            })->count(),
            '31-60' => $carsWithDays->filter(function ($car) {
                return $car['days_at_dealership'] > 30 && $car['days_at_dealership'] <= 60;
            })->count(),
            '61-90' => $carsWithDays->filter(function ($car) {
                return $car['days_at_dealership'] > 60 && $car['days_at_dealership'] <= 90;
            })->count(),
            '90+' => $carsWithDays->filter(function ($car) {
                return $car['days_at_dealership'] > 90;
            })->count(),
        ];

        return [
            'day_ranges' => $dayRanges,
            'cars' => $carsWithDays->toArray(),
            'total_cars' => $cars->count(),
            'avg_days_at_dealership' => $carsWithDays->avg('days_at_dealership'),
            'sold_count' => $carsWithDays->where('is_sold', true)->count(),
            'unsold_count' => $carsWithDays->where('is_sold', false)->count(),
        ];
    }

    /**
     * Generate investment summary report.
     */
    private function generateInvestmentSummaryReport($carsQuery)
    {
        // Get all cars with related data
        $cars = $carsQuery->with(['parts', 'laborEntries', 'paintingEntries', 'sale'])->get();

        // Calculate total investment by category
        $purchaseCost = $cars->sum('purchase_price');
        $partsCost = $cars->sum(function ($car) {
            return $car->parts->sum('total_price');
        });
        $laborCost = $cars->sum(function ($car) {
            return $car->laborEntries->sum('total_cost');
        });
        $paintingCost = $cars->sum(function ($car) {
            return $car->paintingEntries->sum('total_cost');
        });
        $transportationCost = $cars->sum('transportation_cost');
        $registrationCost = $cars->sum('registration_papers_cost');
        $numberPlatesCost = $cars->sum('number_plates_cost');
        $otherCosts = $cars->sum('other_costs');

        // Calculate total investment
        $totalInvestment = $purchaseCost + $partsCost + $laborCost + $paintingCost +
            $transportationCost + $registrationCost + $numberPlatesCost + $otherCosts;

        // Calculate total revenue from sold cars
        $totalRevenue = $cars->whereIn('current_phase', ['sold'])->sum(function ($car) {
            return $car->sale ? $car->sale->selling_price : 0;
        });

        // Calculate estimated value of unsold cars
        $estimatedValue = $cars->whereNotIn('current_phase', ['sold'])->sum('estimated_market_value');

        // Group by make for investment analysis
        $investmentByMake = $cars->groupBy('make')->map(function ($carGroup) {
            $makeInvestment = $carGroup->sum(function ($car) {
                return $car->getTotalInvestmentAttribute();
            });

            $makeRevenue = $carGroup->whereIn('current_phase', ['sold'])->sum(function ($car) {
                return $car->sale ? $car->sale->selling_price : 0;
            });

            $makeEstimatedValue = $carGroup->whereNotIn('current_phase', ['sold'])->sum('estimated_market_value');
            $makePotentialValue = $makeRevenue + $makeEstimatedValue;
            $makePotentialProfit = $makePotentialValue - $makeInvestment;

            return [
                'count' => $carGroup->count(),
                'total_investment' => $makeInvestment,
                'avg_investment' => $carGroup->count() > 0 ? $makeInvestment / $carGroup->count() : 0,
                'revenue' => $makeRevenue,
                'estimated_value' => $makeEstimatedValue,
                'potential_value' => $makePotentialValue,
                'potential_profit' => $makePotentialProfit,
                'roi_percentage' => $makeInvestment > 0 ? ($makePotentialProfit / $makeInvestment) * 100 : 0,
                'sold_count' => $carGroup->where('current_phase', 'sold')->count(),
                'unsold_count' => $carGroup->whereNotIn('current_phase', ['sold'])->count(),
            ];
        })->sortByDesc('total_investment')->toArray();

        // Prepare car details for the report
        $carDetails = $cars->map(function ($car) {
            $totalInvestment = $car->getTotalInvestmentAttribute();
            $value = $car->current_phase === 'sold' && $car->sale ? $car->sale->selling_price : $car->estimated_market_value;
            $profit = $value - $totalInvestment;
            $roi = $totalInvestment > 0 ? ($profit / $totalInvestment) * 100 : 0;

            return [
                'id' => $car->id,
                'year' => $car->year,
                'make' => $car->make,
                'model' => $car->model,
                'vin' => $car->vin,
                'status' => ucfirst($car->current_phase),
                'purchase_date' => $car->purchase_date ? Carbon::parse($car->purchase_date)->format('Y-m-d') : null,
                'sale_date' => $car->sale ? Carbon::parse($car->sale->sale_date)->format('Y-m-d') : null,
                'days_owned' => $car->purchase_date ?
                    ($car->sale ? Carbon::parse($car->purchase_date)->diffInDays(Carbon::parse($car->sale->sale_date)) :
                    Carbon::parse($car->purchase_date)->diffInDays(Carbon::now())) : 0,
                'purchase_price' => $car->purchase_price,
                'repair_cost' => $car->getRepairCostAttribute(),
                'other_costs' => $car->transportation_cost + $car->registration_papers_cost + $car->number_plates_cost + $car->other_costs,
                'total_investment' => $totalInvestment,
                'value' => $value,
                'profit' => $profit,
                'roi' => $roi,
            ];
        })->toArray();

        // Calculate monthly investment and revenue trends
        $monthlyTrends = $this->calculateMonthlyInvestmentTrends($cars);

        return [
            'investment_by_category' => [
                'purchase' => $purchaseCost,
                'parts' => $partsCost,
                'labor' => $laborCost,
                'painting' => $paintingCost,
                'transportation' => $transportationCost,
                'registration' => $registrationCost,
                'number_plates' => $numberPlatesCost,
                'other' => $otherCosts,
            ],
            'investment_by_make' => $investmentByMake,
            'monthly_trends' => $monthlyTrends,
            'total_investment' => $totalInvestment,
            'total_revenue' => $totalRevenue,
            'estimated_value' => $estimatedValue,
            'potential_value' => $totalRevenue + $estimatedValue,
            'potential_profit' => ($totalRevenue + $estimatedValue) - $totalInvestment,
            'roi_percentage' => $totalInvestment > 0 ?
                ((($totalRevenue + $estimatedValue) - $totalInvestment) / $totalInvestment) * 100 : 0,
            'total_cars' => $cars->count(),
            'sold_cars' => $cars->where('current_phase', 'sold')->count(),
            'unsold_cars' => $cars->whereNotIn('current_phase', ['sold'])->count(),
            'cars' => $carDetails,
        ];
    }

    /**
     * Calculate monthly investment and revenue trends.
     */
    private function calculateMonthlyInvestmentTrends($cars)
    {
        $monthlyData = [];

        // Process purchase investments by month
        foreach ($cars as $car) {
            if ($car->purchase_date) {
                $month = Carbon::parse($car->purchase_date)->format('Y-m');

                if (!isset($monthlyData[$month])) {
                    $monthlyData[$month] = [
                        'month_name' => Carbon::parse($car->purchase_date)->format('M Y'),
                        'investment' => 0,
                        'revenue' => 0,
                        'net_flow' => 0,
                        'cars_purchased' => 0,
                        'cars_sold' => 0,
                    ];
                }

                $monthlyData[$month]['investment'] += $car->purchase_price;
                $monthlyData[$month]['cars_purchased']++;
            }

            // Add repair costs to the month they were incurred
            foreach ($car->parts as $part) {
                if ($part->purchase_date) {
                    $month = Carbon::parse($part->purchase_date)->format('Y-m');

                    if (!isset($monthlyData[$month])) {
                        $monthlyData[$month] = [
                            'month_name' => Carbon::parse($part->purchase_date)->format('M Y'),
                            'investment' => 0,
                            'revenue' => 0,
                            'net_flow' => 0,
                            'cars_purchased' => 0,
                            'cars_sold' => 0,
                        ];
                    }

                    $monthlyData[$month]['investment'] += $part->total_price;
                }
            }

            // Process sales revenue by month
            if ($car->sale && $car->sale->sale_date) {
                $month = Carbon::parse($car->sale->sale_date)->format('Y-m');

                if (!isset($monthlyData[$month])) {
                    $monthlyData[$month] = [
                        'month_name' => Carbon::parse($car->sale->sale_date)->format('M Y'),
                        'investment' => 0,
                        'revenue' => 0,
                        'net_flow' => 0,
                        'cars_purchased' => 0,
                        'cars_sold' => 0,
                    ];
                }

                $monthlyData[$month]['revenue'] += $car->sale->selling_price;
                $monthlyData[$month]['cars_sold']++;
            }
        }

        // Calculate net flow for each month
        foreach ($monthlyData as &$data) {
            $data['net_flow'] = $data['revenue'] - $data['investment'];
        }

        // Sort by month
        ksort($monthlyData);

        return array_values($monthlyData);
    }
}
