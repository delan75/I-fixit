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
        // This would typically call the same methods as in the ReportController
        // For simplicity, we'll just return a placeholder
        // In a real implementation, you would copy the logic from ReportController

        return [
            'message' => 'This is a scheduled report generated at ' . now()->format('Y-m-d H:i:s'),
            'report_type' => $reportType->name,
            'cars_count' => $carsQuery->count(),
        ];
    }

    /**
     * Export the report to the specified format.
     */
    private function exportReport(Report $report, $format)
    {
        // This would typically call the same methods as in the ReportController
        // For simplicity, we'll just log a message
        // In a real implementation, you would generate the file and store it

        Log::info('Exporting report to ' . $format, [
            'report_id' => $report->id,
            'format' => $format,
        ]);
    }

    /**
     * Email the report to the specified recipients.
     */
    private function emailReport(Report $report, ScheduledReport $scheduledReport)
    {
        $recipients = explode(',', $scheduledReport->recipients);

        foreach ($recipients as $recipient) {
            $recipient = trim($recipient);

            if (filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                // This would typically send an email with the report attached
                // For simplicity, we'll just log a message
                // In a real implementation, you would use Mail::send()

                Log::info('Sending report to ' . $recipient, [
                    'report_id' => $report->id,
                    'recipient' => $recipient,
                ]);
            }
        }
    }
}
