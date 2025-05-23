<?php

namespace App\Console\Commands;

use App\Models\Car;
use App\Models\Report;
use App\Models\ScheduledReport;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class GenerateScheduledReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:generate-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate scheduled reports that are due to run';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for scheduled reports to generate...');

        // Get all active scheduled reports that are due to run
        $scheduledReports = ScheduledReport::due()->get();

        if ($scheduledReports->isEmpty()) {
            $this->info('No scheduled reports due at this time.');
            return 0;
        }

        $this->info('Found ' . $scheduledReports->count() . ' scheduled reports to generate.');

        foreach ($scheduledReports as $scheduledReport) {
            $this->info('Generating report: ' . $scheduledReport->name);

            try {
                // Generate the report
                $report = $this->generateReport($scheduledReport);

                // Export the report
                $this->exportReport($report, $scheduledReport->export_format);

                // Send the report via email if recipients are specified
                if ($scheduledReport->recipients) {
                    $this->emailReport($report, $scheduledReport);
                }

                // Update the next run time
                $scheduledReport->updateNextRunTime();

                $this->info('Successfully generated report: ' . $report->title);
            } catch (\Exception $e) {
                $this->error('Failed to generate report: ' . $scheduledReport->name);
                $this->error($e->getMessage());
                Log::error('Failed to generate scheduled report: ' . $e->getMessage(), [
                    'scheduled_report_id' => $scheduledReport->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }

        $this->info('Scheduled report generation completed.');
        return 0;
    }

    /**
     * Generate a report based on the scheduled report configuration.
     */
    private function generateReport(ScheduledReport $scheduledReport)
    {
        // Create a new report
        $report = new Report();
        $report->report_type_id = $scheduledReport->report_type_id;
        $report->user_id = $scheduledReport->user_id;
        $report->title = $scheduledReport->name . ' - ' . now()->format('Y-m-d');
        $report->filters = $scheduledReport->filters;

        // Process date range
        $startDate = null;
        $endDate = Carbon::now();

        if (isset($report->filters['date_range'])) {
            switch ($report->filters['date_range']) {
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
                    $startDate = Carbon::parse($report->filters['start_date']);
                    $endDate = Carbon::parse($report->filters['end_date'])->endOfDay();
                    break;
            }
        }

        // Build the base query
        $carsQuery = Car::query();

        // Apply date filters
        if ($startDate) {
            $carsQuery->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('purchase_date', [$startDate, $endDate])
                    ->orWhereBetween('created_at', [$startDate, $endDate]);
            });
        }

        // Apply make filter
        if (isset($report->filters['make']) && $report->filters['make']) {
            $carsQuery->where('make', $report->filters['make']);
        }

        // Apply model filter
        if (isset($report->filters['model']) && $report->filters['model']) {
            $carsQuery->where('model', $report->filters['model']);
        }

        // Apply year filter
        if (isset($report->filters['year']) && $report->filters['year']) {
            $carsQuery->where('year', $report->filters['year']);
        }

        // Apply phase filter
        if (isset($report->filters['phase']) && $report->filters['phase']) {
            $carsQuery->where('current_phase', $report->filters['phase']);
        }

        // Apply selected cars filter
        if (isset($report->filters['selected_cars']) && is_array($report->filters['selected_cars']) && count($report->filters['selected_cars']) > 0) {
            $carsQuery->whereIn('id', $report->filters['selected_cars']);
        }

        // Apply user filter for admins/superusers
        if (isset($report->filters['selected_user_id']) && $report->filters['selected_user_id']) {
            $carsQuery->where('user_id', $report->filters['selected_user_id']);
        } else {
            // Regular users can only see their own cars
            $carsQuery->where('user_id', $report->user_id);
        }

        // Generate report data based on report type
        $reportData = $this->generateReportData($scheduledReport->reportType, $carsQuery);

        $report->data = $reportData;
        $report->generated_at = now();
        $report->save();

        return $report;
    }

    /**
     * Generate report data based on report type and car query.
     */
    private function generateReportData($reportType, $carsQuery)
    {
        $cars = $carsQuery->with(['parts', 'labor', 'painting', 'sale'])->get();
        $data = [];

        // Generate different report data based on report type
        switch ($reportType->slug) {
            case 'profitability-analysis':
                $data = $this->generateProfitabilityReport($cars);
                break;

            case 'repair-cost-analysis':
                $data = $this->generateRepairCostReport($cars);
                break;

            case 'sales-performance':
                $data = $this->generateSalesPerformanceReport($cars);
                break;

            case 'time-at-dealership':
                $data = $this->generateTimeAtDealershipReport($cars);
                break;

            case 'investment-summary':
                $data = $this->generateInvestmentSummaryReport($cars);
                break;

            default:
                $data = [
                    'message' => 'This is a scheduled report generated at ' . now()->format('Y-m-d H:i:s'),
                    'report_type' => $reportType->name,
                    'cars_count' => $cars->count(),
                ];
        }

        return $data;
    }

    /**
     * Generate profitability analysis report.
     */
    private function generateProfitabilityReport($cars)
    {
        // Calculate total purchase cost
        $purchaseCost = $cars->sum('purchase_price');

        // Calculate total parts cost
        $partsCost = $cars->sum(function ($car) {
            return $car->parts->sum('cost');
        });

        // Calculate total labor cost
        $laborCost = $cars->sum(function ($car) {
            return $car->labor->sum('cost');
        });

        // Calculate total painting cost
        $paintingCost = $cars->sum(function ($car) {
            return $car->painting->sum('cost');
        });

        // Calculate other costs
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

        // Calculate profitability by make
        $profitabilityByMake = $cars->groupBy('make')->map(function ($carGroup) {
            $makeInvestment = $carGroup->sum('purchase_price') +
                $carGroup->sum(function ($car) { return $car->parts->sum('cost'); }) +
                $carGroup->sum(function ($car) { return $car->labor->sum('cost'); }) +
                $carGroup->sum(function ($car) { return $car->painting->sum('cost'); }) +
                $carGroup->sum('transportation_cost') +
                $carGroup->sum('registration_papers_cost') +
                $carGroup->sum('number_plates_cost') +
                $carGroup->sum('other_costs');

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

        return [
            'total_investment' => $totalInvestment,
            'total_revenue' => $totalRevenue,
            'estimated_value' => $estimatedValue,
            'potential_value' => $totalRevenue + $estimatedValue,
            'potential_profit' => ($totalRevenue + $estimatedValue) - $totalInvestment,
            'roi_percentage' => $totalInvestment > 0 ?
                ((($totalRevenue + $estimatedValue) - $totalInvestment) / $totalInvestment) * 100 : 0,
            'profitability_by_make' => $profitabilityByMake,
            'total_cars' => $cars->count(),
            'sold_cars' => $cars->where('current_phase', 'sold')->count(),
            'unsold_cars' => $cars->whereNotIn('current_phase', ['sold'])->count(),
        ];
    }

    /**
     * Generate repair cost analysis report.
     */
    private function generateRepairCostReport($cars)
    {
        // Calculate total parts cost
        $partsCost = $cars->sum(function ($car) {
            return $car->parts->sum('cost');
        });

        // Calculate total labor cost
        $laborCost = $cars->sum(function ($car) {
            return $car->labor->sum('cost');
        });

        // Calculate total painting cost
        $paintingCost = $cars->sum(function ($car) {
            return $car->painting->sum('cost');
        });

        // Calculate total repair cost
        $totalRepairCost = $partsCost + $laborCost + $paintingCost;

        // Calculate average repair cost per car
        $avgRepairCost = $cars->count() > 0 ? $totalRepairCost / $cars->count() : 0;

        // Calculate repair cost by make
        $repairCostByMake = $cars->groupBy('make')->map(function ($carGroup) {
            $makePartsCost = $carGroup->sum(function ($car) {
                return $car->parts->sum('cost');
            });

            $makeLaborCost = $carGroup->sum(function ($car) {
                return $car->labor->sum('cost');
            });

            $makePaintingCost = $carGroup->sum(function ($car) {
                return $car->painting->sum('cost');
            });

            $makeTotalRepairCost = $makePartsCost + $makeLaborCost + $makePaintingCost;

            return [
                'count' => $carGroup->count(),
                'parts_cost' => $makePartsCost,
                'labor_cost' => $makeLaborCost,
                'painting_cost' => $makePaintingCost,
                'total_repair_cost' => $makeTotalRepairCost,
                'avg_repair_cost' => $carGroup->count() > 0 ? $makeTotalRepairCost / $carGroup->count() : 0,
            ];
        })->sortByDesc('total_repair_cost')->toArray();

        return [
            'total_repair_cost' => $totalRepairCost,
            'parts_cost' => $partsCost,
            'labor_cost' => $laborCost,
            'painting_cost' => $paintingCost,
            'avg_repair_cost' => $avgRepairCost,
            'repair_cost_by_make' => $repairCostByMake,
            'total_cars' => $cars->count(),
            'cost_distribution' => [
                'parts' => $totalRepairCost > 0 ? ($partsCost / $totalRepairCost) * 100 : 0,
                'labor' => $totalRepairCost > 0 ? ($laborCost / $totalRepairCost) * 100 : 0,
                'painting' => $totalRepairCost > 0 ? ($paintingCost / $totalRepairCost) * 100 : 0,
            ],
        ];
    }

    /**
     * Generate sales performance report.
     */
    private function generateSalesPerformanceReport($cars)
    {
        // Filter sold cars
        $soldCars = $cars->where('current_phase', 'sold');

        // Calculate total sales
        $totalSales = $soldCars->sum(function ($car) {
            return $car->sale ? $car->sale->selling_price : 0;
        });

        // Calculate average sale price
        $avgSalePrice = $soldCars->count() > 0 ? $totalSales / $soldCars->count() : 0;

        // Calculate total investment in sold cars
        $totalInvestment = $soldCars->sum('purchase_price') +
            $soldCars->sum(function ($car) { return $car->parts->sum('cost'); }) +
            $soldCars->sum(function ($car) { return $car->labor->sum('cost'); }) +
            $soldCars->sum(function ($car) { return $car->painting->sum('cost'); }) +
            $soldCars->sum('transportation_cost') +
            $soldCars->sum('registration_papers_cost') +
            $soldCars->sum('number_plates_cost') +
            $soldCars->sum('other_costs');

        // Calculate total profit
        $totalProfit = $totalSales - $totalInvestment;

        // Calculate average profit per car
        $avgProfit = $soldCars->count() > 0 ? $totalProfit / $soldCars->count() : 0;

        // Calculate sales by make
        $salesByMake = $soldCars->groupBy('make')->map(function ($carGroup) {
            $makeSales = $carGroup->sum(function ($car) {
                return $car->sale ? $car->sale->selling_price : 0;
            });

            $makeInvestment = $carGroup->sum('purchase_price') +
                $carGroup->sum(function ($car) { return $car->parts->sum('cost'); }) +
                $carGroup->sum(function ($car) { return $car->labor->sum('cost'); }) +
                $carGroup->sum(function ($car) { return $car->painting->sum('cost'); }) +
                $carGroup->sum('transportation_cost') +
                $carGroup->sum('registration_papers_cost') +
                $carGroup->sum('number_plates_cost') +
                $carGroup->sum('other_costs');

            $makeProfit = $makeSales - $makeInvestment;

            return [
                'count' => $carGroup->count(),
                'total_sales' => $makeSales,
                'avg_sale_price' => $carGroup->count() > 0 ? $makeSales / $carGroup->count() : 0,
                'total_investment' => $makeInvestment,
                'total_profit' => $makeProfit,
                'avg_profit' => $carGroup->count() > 0 ? $makeProfit / $carGroup->count() : 0,
                'profit_margin' => $makeSales > 0 ? ($makeProfit / $makeSales) * 100 : 0,
            ];
        })->sortByDesc('total_sales')->toArray();

        return [
            'total_sales' => $totalSales,
            'avg_sale_price' => $avgSalePrice,
            'total_investment' => $totalInvestment,
            'total_profit' => $totalProfit,
            'avg_profit' => $avgProfit,
            'profit_margin' => $totalSales > 0 ? ($totalProfit / $totalSales) * 100 : 0,
            'sales_by_make' => $salesByMake,
            'total_cars_sold' => $soldCars->count(),
            'total_cars' => $cars->count(),
            'sales_percentage' => $cars->count() > 0 ? ($soldCars->count() / $cars->count()) * 100 : 0,
        ];
    }

    /**
     * Generate time at dealership report.
     */
    private function generateTimeAtDealershipReport($cars)
    {
        // Calculate days at dealership for each car
        $carsWithDays = $cars->map(function ($car) {
            $daysAtDealership = 0;

            if ($car->current_phase === 'dealership') {
                // Car is currently at dealership
                $dealershipStart = $car->dealership_date ? Carbon::parse($car->dealership_date) : null;
                if ($dealershipStart) {
                    $daysAtDealership = $dealershipStart->diffInDays(now());
                }
            } elseif ($car->current_phase === 'sold' && $car->sale) {
                // Car was sold
                $dealershipStart = $car->dealership_date ? Carbon::parse($car->dealership_date) : null;
                $saleDate = $car->sale->sale_date ? Carbon::parse($car->sale->sale_date) : null;

                if ($dealershipStart && $saleDate) {
                    $daysAtDealership = $dealershipStart->diffInDays($saleDate);
                }
            }

            return [
                'id' => $car->id,
                'make' => $car->make,
                'model' => $car->model,
                'year' => $car->year,
                'days_at_dealership' => $daysAtDealership,
                'status' => $car->current_phase,
                'sold' => $car->current_phase === 'sold',
            ];
        });

        // Calculate average days at dealership
        $avgDaysAtDealership = $carsWithDays->avg('days_at_dealership') ?: 0;

        // Calculate days at dealership by make
        $daysByMake = $carsWithDays->groupBy('make')->map(function ($carGroup) {
            return [
                'count' => $carGroup->count(),
                'avg_days' => $carGroup->avg('days_at_dealership') ?: 0,
                'max_days' => $carGroup->max('days_at_dealership') ?: 0,
                'min_days' => $carGroup->min('days_at_dealership') ?: 0,
                'sold_count' => $carGroup->where('sold', true)->count(),
                'unsold_count' => $carGroup->where('sold', false)->count(),
            ];
        })->sortByDesc('avg_days')->toArray();

        return [
            'avg_days_at_dealership' => $avgDaysAtDealership,
            'max_days_at_dealership' => $carsWithDays->max('days_at_dealership') ?: 0,
            'min_days_at_dealership' => $carsWithDays->min('days_at_dealership') ?: 0,
            'days_by_make' => $daysByMake,
            'cars' => $carsWithDays->toArray(),
            'total_cars' => $carsWithDays->count(),
            'sold_count' => $carsWithDays->where('sold', true)->count(),
            'unsold_count' => $carsWithDays->where('sold', false)->count(),
        ];
    }

    /**
     * Generate investment summary report.
     */
    private function generateInvestmentSummaryReport($cars)
    {
        // Calculate total purchase cost
        $purchaseCost = $cars->sum('purchase_price');

        // Calculate total parts cost
        $partsCost = $cars->sum(function ($car) {
            return $car->parts->sum('cost');
        });

        // Calculate total labor cost
        $laborCost = $cars->sum(function ($car) {
            return $car->labor->sum('cost');
        });

        // Calculate total painting cost
        $paintingCost = $cars->sum(function ($car) {
            return $car->painting->sum('cost');
        });

        // Calculate other costs
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

        // Calculate investment by make
        $investmentByMake = $cars->groupBy('make')->map(function ($carGroup) {
            $makeInvestment = $carGroup->sum('purchase_price') +
                $carGroup->sum(function ($car) { return $car->parts->sum('cost'); }) +
                $carGroup->sum(function ($car) { return $car->labor->sum('cost'); }) +
                $carGroup->sum(function ($car) { return $car->painting->sum('cost'); }) +
                $carGroup->sum('transportation_cost') +
                $carGroup->sum('registration_papers_cost') +
                $carGroup->sum('number_plates_cost') +
                $carGroup->sum('other_costs');

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
        ];
    }

    /**
     * Export the report to the specified format.
     */
    private function exportReport(Report $report, $format)
    {
        try {
            $fileName = Str::slug($report->title) . '_' . now()->format('Y-m-d_H-i-s');
            $filePath = null;

            switch ($format) {
                case 'pdf':
                    $filePath = $this->exportToPdf($report, $fileName);
                    break;

                case 'xlsx':
                    $filePath = $this->exportToExcel($report, $fileName);
                    break;

                case 'csv':
                    $filePath = $this->exportToCsv($report, $fileName);
                    break;

                default:
                    throw new \Exception('Unsupported export format: ' . $format);
            }

            if ($filePath) {
                $report->file_path = $filePath;
                $report->file_type = $format;
                $report->save();

                $this->info('Report exported to ' . $filePath);
            }
        } catch (\Exception $e) {
            $this->error('Failed to export report: ' . $e->getMessage());
            Log::error('Failed to export report: ' . $e->getMessage(), [
                'report_id' => $report->id,
                'format' => $format,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Export report to PDF.
     */
    private function exportToPdf($report, $fileName)
    {
        $reportType = $report->reportType;
        $data = $report->data;
        $filters = $report->filters;

        $view = 'reports.pdf.' . $reportType->slug;

        // Check if the view exists
        if (!view()->exists($view)) {
            $view = 'reports.pdf.default';
        }

        $pdf = Pdf::loadView($view, [
            'report' => $report,
            'reportType' => $reportType,
            'data' => $data,
            'filters' => $filters,
            'generatedAt' => now()->format('Y-m-d H:i:s'),
        ]);

        $filePath = 'reports/' . $fileName . '.pdf';
        $fullPath = storage_path('app/public/' . $filePath);

        // Ensure the directory exists
        $directory = dirname($fullPath);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $pdf->save($fullPath);

        return 'storage/' . $filePath;
    }

    /**
     * Export report to Excel.
     */
    private function exportToExcel($report, $fileName)
    {
        $export = new \App\Exports\ReportExport($report);
        $filePath = 'reports/' . $fileName . '.xlsx';
        $fullPath = storage_path('app/public/' . $filePath);

        // Ensure the directory exists
        $directory = dirname($fullPath);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        Excel::store($export, 'public/' . $filePath);

        return 'storage/' . $filePath;
    }

    /**
     * Export report to CSV.
     */
    private function exportToCsv($report, $fileName)
    {
        $export = new \App\Exports\ReportExport($report);
        $filePath = 'reports/' . $fileName . '.csv';
        $fullPath = storage_path('app/public/' . $filePath);

        // Ensure the directory exists
        $directory = dirname($fullPath);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        Excel::store($export, 'public/' . $filePath, null, \Maatwebsite\Excel\Excel::CSV);

        return 'storage/' . $filePath;
    }

    /**
     * Email the report to the specified recipients.
     */
    private function emailReport(Report $report, ScheduledReport $scheduledReport)
    {
        $recipients = explode(',', $scheduledReport->recipients);
        $user = $scheduledReport->user;

        foreach ($recipients as $recipient) {
            $recipient = trim($recipient);

            if (filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                try {
                    Mail::send('emails.scheduled-report', [
                        'report' => $report,
                        'scheduledReport' => $scheduledReport,
                        'user' => $user,
                        'title' => 'Scheduled Report: ' . $report->title,
                        'actionUrl' => route('reports.show', $report),
                        'actionText' => 'View Report',
                    ], function ($message) use ($recipient, $report, $scheduledReport) {
                        $message->to($recipient)
                            ->subject('I-fixit: Scheduled Report - ' . $report->title);

                        // Attach the report file if available
                        if ($report->file_path) {
                            $filePath = str_replace('storage/', 'public/', $report->file_path);
                            $fileName = basename($report->file_path);

                            $message->attach(storage_path('app/' . $filePath), [
                                'as' => $fileName,
                            ]);
                        }
                    });

                    $this->info('Report sent to ' . $recipient);
                } catch (\Exception $e) {
                    $this->error('Failed to send report to ' . $recipient . ': ' . $e->getMessage());
                    Log::error('Failed to send report email: ' . $e->getMessage(), [
                        'report_id' => $report->id,
                        'recipient' => $recipient,
                        'error' => $e->getMessage(),
                    ]);
                }
            } else {
                $this->warn('Invalid email address: ' . $recipient);
                Log::warning('Invalid email address for scheduled report', [
                    'report_id' => $report->id,
                    'recipient' => $recipient,
                ]);
            }
        }
    }
}
