<?php

namespace App\Console\Commands;

use App\Services\ApiAuthService;
use Illuminate\Console\Command;

class TestApiAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:test-auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test API authentication and connection';

    /**
     * Execute the console command.
     */
    public function handle(ApiAuthService $apiAuthService)
    {
        $this->info('Testing API Authentication...');
        $this->newLine();

        try {
            // Test connection
            $result = $apiAuthService->testConnection();

            if ($result['success']) {
                $this->info('✅ API Connection: SUCCESS');
                $this->info('✅ Authentication: SUCCESS');
                $this->info('✅ Health endpoint accessible');
            } else {
                $this->error('❌ API Connection: FAILED');
                $this->error('Details: ' . ($result['details']['error'] ?? 'Unknown error'));
            }

            $this->newLine();

            // Test token generation
            $this->info('Testing token generation...');
            $token = $apiAuthService->getToken();

            if ($token) {
                $this->info('✅ JWT Token: Generated successfully');
                $this->info('Token preview: ' . substr($token, 0, 50) . '...');
            } else {
                $this->error('❌ JWT Token: Failed to generate');
            }

            $this->newLine();

            // Test protected endpoint
            $this->info('Testing protected endpoint access...');
            $result = $apiAuthService->makeRequest('get', '/api/v1/opportunities/');

            if ($result['success']) {
                $this->info('✅ Protected Endpoint: Accessible');
                $this->info('Response status: ' . $result['status']);
            } else {
                $this->error('❌ Protected Endpoint: Access denied');
                $this->error('Error: ' . ($result['error'] ?? 'Unknown error'));
            }

        } catch (\Exception $e) {
            $this->error('❌ Test failed with exception: ' . $e->getMessage());
            return 1;
        }

        $this->newLine();
        $this->info('API authentication test completed.');

        return 0;
    }
}
