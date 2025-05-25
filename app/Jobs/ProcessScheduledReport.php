<?php

namespace App\Jobs;

use App\Models\Car;
use App\Models\Report;
use App\Models\ScheduledReport;
use App\Services\ActivityLogService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ProcessScheduledReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $scheduledReport;

    /**
     * Create a new job instance.
     */
    public function __construct(ScheduledReport $scheduledReport)
    {
        $this->scheduledReport = $scheduledReport;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('Processing scheduled report: ' . $this->scheduledReport->name);

            // Generate the report
            $report = $this->generateReport();

            // Export the report
            $this->exportReport($report, $this->scheduledReport->export_format);

            // Send the report via email if recipients are specified
            if ($this->scheduledReport->recipients) {
                $this->emailReport($report);
            }

            // Update the next run time
            $this->scheduledReport->updateNextRunTime();

            // Log the successful generation
            ActivityLogService::log(
                'scheduled_report_generated',
                "Generated scheduled report: {$this->scheduledReport->name}",
                $this->scheduledReport->user_id,
                [
                    'model_type' => 'ScheduledReport',
                    'model_id' => $this->scheduledReport->id,
                    'report_id' => $report->id
                ]
            );

            Log::info('Successfully processed scheduled report: ' . $this->scheduledReport->name);

        } catch (\Exception $e) {
            Log::error('Failed to process scheduled report: ' . $e->getMessage(), [
                'scheduled_report_id' => $this->scheduledReport->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Log the failure
            ActivityLogService::log(
                'scheduled_report_failed',
                "Failed to generate scheduled report: {$this->scheduledReport->name}. Error: {$e->getMessage()}",
                $this->scheduledReport->user_id,
                [
                    'model_type' => 'ScheduledReport',
                    'model_id' => $this->scheduledReport->id,
                    'error' => $e->getMessage()
                ]
            );

            throw $e;
        }
    }

    /**
     * Generate a report based on the scheduled report configuration.
     */
    private function generateReport()
    {
        // Create a new report
        $report = new Report();
        $report->report_type_id = $this->scheduledReport->report_type_id;
        $report->user_id = $this->scheduledReport->user_id;
        $report->title = $this->scheduledReport->name . ' - ' . now()->format('Y-m-d');
        $report->filters = $this->scheduledReport->filters;

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

        // Apply filters
        if (isset($report->filters['make']) && $report->filters['make']) {
            $carsQuery->where('make', $report->filters['make']);
        }

        if (isset($report->filters['model']) && $report->filters['model']) {
            $carsQuery->where('model', $report->filters['model']);
        }

        if (isset($report->filters['year']) && $report->filters['year']) {
            $carsQuery->where('year', $report->filters['year']);
        }

        if (isset($report->filters['phase']) && $report->filters['phase']) {
            $carsQuery->where('current_phase', $report->filters['phase']);
        }

        if (isset($report->filters['selected_cars']) && is_array($report->filters['selected_cars']) && count($report->filters['selected_cars']) > 0) {
            $carsQuery->whereIn('id', $report->filters['selected_cars']);
        }

        // Apply user filter
        if (isset($report->filters['selected_user_id']) && $report->filters['selected_user_id']) {
            $carsQuery->where('user_id', $report->filters['selected_user_id']);
        } else {
            $carsQuery->where('user_id', $report->user_id);
        }

        // Generate report data
        $reportData = $this->generateReportData($carsQuery);

        $report->data = $reportData;
        $report->generated_at = now();
        $report->save();

        return $report;
    }

    /**
     * Generate report data based on car query.
     */
    private function generateReportData($carsQuery)
    {
        $cars = $carsQuery->with(['parts', 'labor', 'painting', 'sale'])->get();

        // Calculate basic metrics
        $totalInvestment = $cars->sum(function ($car) {
            return $car->purchase_price +
                   $car->parts->sum('cost') +
                   $car->labor->sum('total_cost') +
                   $car->painting->sum('total_cost') +
                   ($car->transportation_cost ?? 0) +
                   ($car->registration_papers_cost ?? 0) +
                   ($car->number_plates_cost ?? 0) +
                   ($car->other_costs ?? 0);
        });

        $totalRevenue = $cars->where('current_phase', 'sold')->sum(function ($car) {
            return $car->sale ? $car->sale->selling_price : 0;
        });

        $estimatedValue = $cars->whereNotIn('current_phase', ['sold'])->sum('estimated_market_value');
        $potentialValue = $totalRevenue + $estimatedValue;
        $potentialProfit = $potentialValue - $totalInvestment;

        return [
            'total_cars' => $cars->count(),
            'sold_cars' => $cars->where('current_phase', 'sold')->count(),
            'unsold_cars' => $cars->whereNotIn('current_phase', ['sold'])->count(),
            'total_investment' => $totalInvestment,
            'total_revenue' => $totalRevenue,
            'estimated_value' => $estimatedValue,
            'potential_value' => $potentialValue,
            'potential_profit' => $potentialProfit,
            'roi_percentage' => $totalInvestment > 0 ? ($potentialProfit / $totalInvestment) * 100 : 0,
            'cars' => $cars->map(function ($car) {
                $investment = $car->purchase_price +
                             $car->parts->sum('cost') +
                             $car->labor->sum('total_cost') +
                             $car->painting->sum('total_cost') +
                             ($car->transportation_cost ?? 0) +
                             ($car->registration_papers_cost ?? 0) +
                             ($car->number_plates_cost ?? 0) +
                             ($car->other_costs ?? 0);

                $value = $car->current_phase === 'sold'
                    ? ($car->sale ? $car->sale->selling_price : 0)
                    : ($car->estimated_market_value ?? 0);

                return [
                    'id' => $car->id,
                    'year' => $car->year,
                    'make' => $car->make,
                    'model' => $car->model,
                    'status' => $car->current_phase,
                    'purchase_price' => $car->purchase_price,
                    'total_investment' => $investment,
                    'value' => $value,
                    'profit' => $value - $investment,
                ];
            })->toArray(),
        ];
    }

    /**
     * Export the report to the specified format.
     */
    private function exportReport(Report $report, $format)
    {
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
        }

        if ($filePath) {
            $report->file_path = $filePath;
            $report->file_type = $format;
            $report->save();
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

        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
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

        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
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

        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }

        Excel::store($export, 'public/' . $filePath, null, \Maatwebsite\Excel\Excel::CSV);
        return 'storage/' . $filePath;
    }

    /**
     * Email the report to the specified recipients.
     */
    private function emailReport(Report $report)
    {
        $recipients = explode(',', $this->scheduledReport->recipients);
        $user = $this->scheduledReport->user;

        foreach ($recipients as $recipient) {
            $recipient = trim($recipient);

            if (filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                try {
                    Mail::send('emails.scheduled-report', [
                        'report' => $report,
                        'scheduledReport' => $this->scheduledReport,
                        'user' => $user,
                        'title' => 'Scheduled Report: ' . $report->title,
                        'actionUrl' => route('reports.show', $report),
                        'actionText' => 'View Report',
                    ], function ($message) use ($recipient, $report) {
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

                    Log::info('Report sent to ' . $recipient);
                } catch (\Exception $e) {
                    Log::error('Failed to send report to ' . $recipient . ': ' . $e->getMessage());
                }
            }
        }
    }
}
