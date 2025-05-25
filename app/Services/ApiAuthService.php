<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ApiAuthService
{
    private string $baseUrl;
    private string $username;
    private string $password;
    private string $email;

    public function __construct()
    {
        $this->baseUrl = env('API_BASE_URL', 'http://127.0.0.1:8000');
        $this->username = env('API_SERVICE_USERNAME');
        $this->password = env('API_SERVICE_PASSWORD');
        $this->email = env('API_SERVICE_EMAIL');

        if (empty($this->baseUrl)) {
            throw new Exception('API base URL not configured');
        }

        if (empty($this->username) || empty($this->password)) {
            throw new Exception('API service credentials not configured');
        }
    }

    /**
     * Get a valid JWT token (cached or fresh)
     */
    public function getToken(): ?string
    {
        $cacheKey = 'api_jwt_token';

        // Try to get cached token
        $token = Cache::get($cacheKey);

        if ($token && $this->isTokenValid($token)) {
            return $token;
        }

        // Get fresh token
        $token = $this->authenticate();

        if ($token) {
            // Cache token for 50 minutes (expires in 60)
            Cache::put($cacheKey, $token, now()->addMinutes(50));
        }

        return $token;
    }

    /**
     * Authenticate with the API and get JWT token
     */
    private function authenticate(): ?string
    {
        try {
            Log::info('Attempting API authentication', [
                'url' => $this->baseUrl . '/api/v1/auth/login/',
                'username' => $this->username
            ]);

            $response = Http::timeout(10)->post($this->baseUrl . '/api/v1/auth/login/', [
                'username' => $this->username,
                'password' => $this->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['access'])) {
                    Log::info('API authentication successful');

                    // Store refresh token if available
                    if (isset($data['refresh'])) {
                        Cache::put('api_refresh_token', $data['refresh'], now()->addDays(7));
                    }

                    return $data['access'];
                }

                Log::error('API authentication failed - no access token in response', [
                    'response_keys' => array_keys($data),
                    'response' => $data
                ]);
            } else {
                Log::error('API authentication failed', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'url' => $this->baseUrl . '/api/v1/auth/login/'
                ]);
            }

            return null;
        } catch (Exception $e) {
            Log::error('API authentication error: ' . $e->getMessage(), [
                'url' => $this->baseUrl . '/api/v1/auth/login/',
                'error_type' => get_class($e)
            ]);
            return null;
        }
    }

    /**
     * Check if token is still valid (basic check)
     */
    private function isTokenValid(string $token): bool
    {
        try {
            // Basic JWT structure check
            $parts = explode('.', $token);
            if (count($parts) !== 3) {
                return false;
            }

            // Decode payload to check expiration
            $payload = json_decode(base64_decode($parts[1]), true);

            if (!isset($payload['exp'])) {
                return false;
            }

            // Check if token expires in next 5 minutes
            return $payload['exp'] > (time() + 300);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Make authenticated API request
     */
    public function makeRequest(string $method, string $endpoint, array $data = []): array
    {
        $token = $this->getToken();

        if (!$token) {
            Log::warning('API request failed - no valid token available', [
                'endpoint' => $endpoint,
                'method' => $method
            ]);

            return [
                'success' => false,
                'error' => 'Unable to authenticate with API',
                'status' => 401
            ];
        }

        try {
            Log::debug('Making authenticated API request', [
                'method' => $method,
                'endpoint' => $endpoint,
                'url' => $this->baseUrl . $endpoint
            ]);

            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->$method($this->baseUrl . $endpoint, $data);

            $result = [
                'success' => $response->successful(),
                'status' => $response->status(),
                'data' => $response->json(),
                'response' => $response
            ];

            if (!$response->successful()) {
                Log::warning('API request returned error status', [
                    'method' => $method,
                    'endpoint' => $endpoint,
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);

                $result['error'] = 'API returned status ' . $response->status();
            } else {
                Log::debug('API request successful', [
                    'method' => $method,
                    'endpoint' => $endpoint,
                    'status' => $response->status()
                ]);
            }

            return $result;
        } catch (Exception $e) {
            Log::error('API request failed with exception: ' . $e->getMessage(), [
                'endpoint' => $endpoint,
                'method' => $method,
                'error_type' => get_class($e),
                'url' => $this->baseUrl . $endpoint
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
                'status' => 0
            ];
        }
    }

    /**
     * Refresh the JWT token
     */
    public function refreshToken(): ?string
    {
        $refreshToken = Cache::get('api_refresh_token');

        if (!$refreshToken) {
            return $this->authenticate();
        }

        try {
            $response = Http::timeout(10)->post($this->baseUrl . '/api/v1/auth/refresh/', [
                'refresh' => $refreshToken,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['access'])) {
                    $token = $data['access'];
                    Cache::put('api_jwt_token', $token, now()->addMinutes(50));
                    return $token;
                }
            }

            // If refresh fails, get new token
            return $this->authenticate();
        } catch (Exception $e) {
            Log::error('Token refresh failed: ' . $e->getMessage());
            return $this->authenticate();
        }
    }

    /**
     * Clear cached tokens (for logout or security)
     */
    public function clearTokens(): void
    {
        Cache::forget('api_jwt_token');
        Cache::forget('api_refresh_token');
    }

    /**
     * Test API connection and authentication
     */
    public function testConnection(): array
    {
        try {
            // First test basic connectivity without authentication
            $healthResult = $this->testBasicConnectivity();

            if (!$healthResult['success']) {
                return [
                    'success' => false,
                    'authenticated' => false,
                    'message' => 'API server is not reachable',
                    'details' => $healthResult
                ];
            }

            // Test authentication
            $result = $this->makeRequest('get', '/api/v1/health/');

            return [
                'success' => $result['success'],
                'authenticated' => $result['success'],
                'message' => $result['success'] ? 'API connection and authentication successful' : 'API authentication failed',
                'details' => $result
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'authenticated' => false,
                'message' => 'API connection test failed: ' . $e->getMessage(),
                'details' => ['error' => $e->getMessage()]
            ];
        }
    }

    /**
     * Test basic API connectivity without authentication
     */
    private function testBasicConnectivity(): array
    {
        try {
            $response = Http::timeout(5)->get($this->baseUrl . '/api/v1/health/');

            return [
                'success' => true,
                'status' => $response->status(),
                'response_time' => $response->transferStats->getTransferTime() ?? 0
            ];
        } catch (Exception $e) {
            Log::error('Basic API connectivity test failed: ' . $e->getMessage(), [
                'url' => $this->baseUrl . '/api/v1/health/'
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get API status for dashboard display
     */
    public function getApiStatus(): array
    {
        try {
            $startTime = microtime(true);
            $result = $this->makeRequest('get', '/api/v1/health/');
            $responseTime = microtime(true) - $startTime;

            return [
                'status' => $result['success'] ? 'online' : 'offline',
                'response_time' => $responseTime,
                'last_checked' => now(),
                'authenticated' => $result['success']
            ];
        } catch (Exception $e) {
            return [
                'status' => 'offline',
                'response_time' => 0,
                'error' => $e->getMessage(),
                'last_checked' => now(),
                'authenticated' => false
            ];
        }
    }
}
