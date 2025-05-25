<?php

namespace App\Jobs;

use App\Models\Car;
use App\Models\User;
use App\Services\NotificationService;
use App\Services\ActivityLogService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SmartNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('SmartNotificationJob: Starting smart notification checks');

            // Check for cars in fixing phase for 30+ days
            $this->checkLongFixingPhaseCars();

            // Check for cars approaching auction end dates
            $this->checkUpcomingAuctions();

            // Check for cars with high repair costs
            $this->checkHighRepairCosts();

            // Check for cars at dealership for extended periods
            $this->checkLongDealershipCars();

            Log::info('SmartNotificationJob: Completed smart notification checks');
        } catch (\Exception $e) {
            Log::error('SmartNotificationJob Error: ' . $e->getMessage());
        }
    }

    /**
     * Check for cars in fixing phase for 30+ days
     */
    private function checkLongFixingPhaseCars()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        $longFixingCars = Car::where('current_phase', 'fixing')
            ->where('repair_start_date', '<=', $thirtyDaysAgo)
            ->whereNull('repair_end_date')
            ->with('user')
            ->get();

        foreach ($longFixingCars as $car) {
            $daysInFixing = Carbon::parse($car->repair_start_date)->diffInDays(Carbon::now());

            // Send notification to car owner
            $notificationService = app(NotificationService::class);
            $notificationService->create(
                $car->user,
                'long_fixing_phase',
                'Car in Fixing Phase Alert',
                "Your {$car->year} {$car->make} {$car->model} has been in the fixing phase for {$daysInFixing} days. Consider reviewing the repair progress.",
                [
                    'car_id' => $car->id,
                    'days_in_fixing' => $daysInFixing,
                    'type' => 'long_fixing_phase'
                ],
                'fa-wrench',
                route('cars.show', $car->id)
            );

            // Send notification to admin users
            $adminUsers = User::where('role', 'admin')->get();
            foreach ($adminUsers as $admin) {
                $notificationService->create(
                    $admin,
                    'admin_long_fixing_alert',
                    'Long Fixing Phase Alert',
                    "Car {$car->year} {$car->make} {$car->model} (Owner: {$car->user->name}) has been in fixing phase for {$daysInFixing} days.",
                    [
                        'car_id' => $car->id,
                        'owner_name' => $car->user->name,
                        'days_in_fixing' => $daysInFixing,
                        'type' => 'admin_long_fixing_alert'
                    ],
                    'fa-exclamation-triangle',
                    route('cars.show', $car->id)
                );
            }

            ActivityLogService::log('long_fixing_alert_sent', "Sent long fixing phase alert for car {$car->id} ({$daysInFixing} days)");
        }

        Log::info("SmartNotificationJob: Checked {$longFixingCars->count()} cars in long fixing phase");
    }

    /**
     * Check for cars approaching auction end dates (from opportunities)
     */
    private function checkUpcomingAuctions()
    {
        // This would integrate with the Opportunity model when available
        // For now, we'll skip this check
        Log::info('SmartNotificationJob: Skipping auction checks (Opportunity model not yet integrated)');
    }

    /**
     * Check for cars with high repair costs relative to purchase price
     */
    private function checkHighRepairCosts()
    {
        $carsWithHighRepairCosts = Car::whereRaw('estimated_repair_cost > purchase_price * 0.7')
            ->where('current_phase', 'fixing')
            ->with('user')
            ->get();

        foreach ($carsWithHighRepairCosts as $car) {
            $repairCostPercentage = ($car->estimated_repair_cost / $car->purchase_price) * 100;

            $notificationService = app(NotificationService::class);
            $notificationService->create(
                $car->user,
                'high_repair_cost',
                'High Repair Cost Alert',
                "Your {$car->year} {$car->make} {$car->model} has repair costs of R" . number_format($car->estimated_repair_cost, 2) . " (" . number_format($repairCostPercentage, 1) . "% of purchase price). Consider reviewing the investment viability.",
                [
                    'car_id' => $car->id,
                    'repair_cost' => $car->estimated_repair_cost,
                    'repair_percentage' => $repairCostPercentage,
                    'type' => 'high_repair_cost'
                ],
                'fa-exclamation-triangle',
                route('cars.show', $car->id)
            );

            ActivityLogService::log('high_repair_cost_alert_sent', "Sent high repair cost alert for car {$car->id} (" . number_format($repairCostPercentage, 1) . "%)");
        }

        Log::info("SmartNotificationJob: Checked {$carsWithHighRepairCosts->count()} cars with high repair costs");
    }

    /**
     * Check for cars at dealership for extended periods (60+ days)
     */
    private function checkLongDealershipCars()
    {
        $sixtyDaysAgo = Carbon::now()->subDays(60);

        $longDealershipCars = Car::where('current_phase', 'dealership')
            ->where('dealership_date', '<=', $sixtyDaysAgo)
            ->with('user')
            ->get();

        foreach ($longDealershipCars as $car) {
            $daysAtDealership = Carbon::parse($car->dealership_date)->diffInDays(Carbon::now());

            $notificationService = app(NotificationService::class);
            $notificationService->create(
                $car->user,
                'long_dealership_period',
                'Long Dealership Period Alert',
                "Your {$car->year} {$car->make} {$car->model} has been at the dealership for {$daysAtDealership} days. Consider reviewing pricing or marketing strategy.",
                [
                    'car_id' => $car->id,
                    'days_at_dealership' => $daysAtDealership,
                    'type' => 'long_dealership_period'
                ],
                'fa-store',
                route('cars.show', $car->id)
            );

            ActivityLogService::log('long_dealership_alert_sent', "Sent long dealership period alert for car {$car->id} ({$daysAtDealership} days)");
        }

        Log::info("SmartNotificationJob: Checked {$longDealershipCars->count()} cars with long dealership periods");
    }
}
