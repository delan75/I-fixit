<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\Car;
use App\Services\ActivityLogService;
use App\Services\ApiAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ApiIntegrationController extends Controller
{
    protected $apiAuthService;

    public function __construct(ApiAuthService $apiAuthService)
    {
        $this->middleware(['auth', 'admin']); // Only admin users can access
        $this->apiAuthService = $apiAuthService;
    }

    /**
     * Display the API integration dashboard
     */
    public function index()
    {
        try {
            // Get API status
            $apiStatus = $this->checkApiStatus();

            // Get recent opportunities from local database
            $recentOpportunities = Opportunity::with('viewedBy')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            // Get high-scoring opportunities
            $highScoringOpportunities = Opportunity::where('opportunity_score', '>=', 80)
                ->where('status', 'new')
                ->orderBy('opportunity_score', 'desc')
                ->take(5)
                ->get();

            // Get API statistics
            $stats = [
                'total_opportunities' => Opportunity::count(),
                'new_opportunities' => Opportunity::where('status', 'new')->count(),
                'high_score_opportunities' => Opportunity::where('opportunity_score', '>=', 80)->count(),
                'opportunities_today' => Opportunity::whereDate('created_at', today())->count(),
            ];

            ActivityLogService::log('api_dashboard_viewed', 'Viewed API integration dashboard');

            return view('api-integration.index', compact(
                'apiStatus',
                'recentOpportunities',
                'highScoringOpportunities',
                'stats'
            ));
        } catch (\Exception $e) {
            Log::error('API Integration Dashboard Error: ' . $e->getMessage());
            return view('api-integration.index')->with('error', 'Unable to load API data');
        }
    }

    /**
     * Sync opportunities from Django API
     */
    public function syncOpportunities()
    {
        try {
            $result = $this->apiAuthService->makeRequest('get', '/api/v1/opportunities/');

            if ($result['success']) {
                $apiOpportunities = $result['data']['data'] ?? [];
                $syncedCount = 0;
                $updatedCount = 0;

                foreach ($apiOpportunities as $apiOpportunity) {
                    $existingOpportunity = Opportunity::where('api_opportunity_id', $apiOpportunity['id'])->first();

                    if ($existingOpportunity) {
                        // Update existing opportunity
                        $existingOpportunity->update($this->mapApiOpportunityData($apiOpportunity));
                        $updatedCount++;
                    } else {
                        // Create new opportunity
                        Opportunity::create(array_merge(
                            $this->mapApiOpportunityData($apiOpportunity),
                            ['api_opportunity_id' => $apiOpportunity['id']]
                        ));
                        $syncedCount++;
                    }
                }

                ActivityLogService::log('opportunities_synced', "Synced {$syncedCount} new and updated {$updatedCount} opportunities from API");

                return response()->json([
                    'success' => true,
                    'message' => "Successfully synced {$syncedCount} new opportunities and updated {$updatedCount} existing ones.",
                    'synced' => $syncedCount,
                    'updated' => $updatedCount
                ]);
            } else {
                throw new \Exception('API request failed: ' . ($result['error'] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            Log::error('Opportunity Sync Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to sync opportunities: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Trigger scraping job via API
     */
    public function triggerScraping(Request $request)
    {
        $request->validate([
            'auction_site_id' => 'required|integer'
        ]);

        try {
            $result = $this->apiAuthService->makeRequest('post', '/api/v1/scrape/', [
                'auction_site_id' => $request->auction_site_id
            ]);

            if ($result['success']) {
                $data = $result['data'];

                ActivityLogService::log('scraping_triggered', "Triggered scraping job for auction site {$request->auction_site_id}");

                return response()->json([
                    'success' => true,
                    'message' => $data['message'] ?? 'Scraping job triggered successfully',
                    'job_id' => $data['job_id'] ?? null
                ]);
            } else {
                throw new \Exception('API request failed: ' . ($result['error'] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            Log::error('Scraping Trigger Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to trigger scraping: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get market analysis for a specific car
     */
    public function getMarketAnalysis(Car $car)
    {
        try {
            $result = $this->apiAuthService->makeRequest('get', "/api/v1/cars/{$car->id}/market-analysis/");

            if ($result['success']) {
                $analysis = $result['data']['data'] ?? [];

                ActivityLogService::log('market_analysis_requested', "Requested market analysis for car {$car->id}");

                return response()->json([
                    'success' => true,
                    'data' => $analysis
                ]);
            } else {
                throw new \Exception('API request failed: ' . ($result['error'] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            Log::error('Market Analysis Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get market analysis: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check API status
     */
    private function checkApiStatus()
    {
        return $this->apiAuthService->getApiStatus();
    }

    /**
     * Map API opportunity data to local model structure
     */
    private function mapApiOpportunityData($apiOpportunity)
    {
        return [
            'source' => $apiOpportunity['source'] ?? '',
            'listing_url' => $apiOpportunity['listing_url'] ?? '',
            'make' => $apiOpportunity['make'] ?? '',
            'model' => $apiOpportunity['model'] ?? '',
            'year' => $apiOpportunity['year'] ?? 0,
            'auction_end_date' => $apiOpportunity['auction_end_date'] ?? null,
            'current_bid' => $apiOpportunity['current_bid'] ?? null,
            'lot_number' => $apiOpportunity['lot_number'] ?? null,
            'auction_location' => $apiOpportunity['auction_location'] ?? null,
            'stock_number' => $apiOpportunity['stock_number'] ?? null,
            'odometer' => $apiOpportunity['odometer'] ?? null,
            'vehicle_code' => $apiOpportunity['vehicle_code'] ?? null,
            'has_keys' => $apiOpportunity['has_keys'] ?? false,
            'has_spare_key' => $apiOpportunity['has_spare_key'] ?? false,
            'vehicle_starts' => $apiOpportunity['vehicle_starts'] ?? false,
            'has_battery' => $apiOpportunity['has_battery'] ?? false,
            'has_spare_wheel' => $apiOpportunity['has_spare_wheel'] ?? false,
            'color' => $apiOpportunity['color'] ?? null,
            'auction_date' => $apiOpportunity['auction_date'] ?? null,
            'damage_description' => $apiOpportunity['damage_description'] ?? null,
            'image_urls' => $apiOpportunity['image_urls'] ?? null,
            'estimated_repair_cost' => $apiOpportunity['estimated_repair_cost'] ?? null,
            'estimated_market_value' => $apiOpportunity['estimated_market_value'] ?? null,
            'potential_profit' => $apiOpportunity['potential_profit'] ?? null,
            'opportunity_score' => $apiOpportunity['opportunity_score'] ?? 0,
            'status' => $apiOpportunity['status'] ?? 'new',
        ];
    }
}
