<?php

namespace App\Console\Commands;

use App\Services\ApiAuthService;
use Illuminate\Console\Command;

class ClearApiTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:clear-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear cached API authentication tokens';

    /**
     * Execute the console command.
     */
    public function handle(ApiAuthService $apiAuthService)
    {
        $this->info('Clearing API authentication tokens...');

        $apiAuthService->clearTokens();

        $this->info('✅ API tokens cleared successfully.');
        $this->info('Next API request will require fresh authentication.');

        return 0;
    }
}
