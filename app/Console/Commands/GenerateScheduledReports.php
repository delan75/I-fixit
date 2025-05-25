<?php

namespace App\Console\Commands;

use App\Jobs\ProcessScheduledReport;
use App\Models\ScheduledReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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

        $processedCount = 0;
        $failedCount = 0;

        foreach ($scheduledReports as $scheduledReport) {
            $this->info('Dispatching report job: ' . $scheduledReport->name);

            try {
                // Dispatch the job to process the scheduled report
                ProcessScheduledReport::dispatch($scheduledReport);
                $processedCount++;
                $this->info('Successfully dispatched job for: ' . $scheduledReport->name);
            } catch (\Exception $e) {
                $failedCount++;
                $this->error('Failed to dispatch job for report: ' . $scheduledReport->name);
                $this->error($e->getMessage());
                Log::error('Failed to dispatch scheduled report job: ' . $e->getMessage(), [
                    'scheduled_report_id' => $scheduledReport->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }

        $this->info("Scheduled report processing completed. Dispatched: {$processedCount}, Failed: {$failedCount}");

        if ($failedCount === 0) {
            $this->info('All scheduled reports have been queued for processing.');
        } else {
            $this->warn("Some reports failed to be queued. Check the logs for details.");
        }

        return $failedCount > 0 ? 1 : 0;
    }
}
