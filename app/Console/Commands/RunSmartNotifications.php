<?php

namespace App\Console\Commands;

use App\Jobs\SmartNotificationJob;
use Illuminate\Console\Command;

class RunSmartNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:smart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run smart notifications to check for cars requiring attention';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting smart notifications check...');

        // Dispatch the smart notification job
        SmartNotificationJob::dispatch();

        $this->info('Smart notifications job dispatched successfully.');

        return 0;
    }
}
