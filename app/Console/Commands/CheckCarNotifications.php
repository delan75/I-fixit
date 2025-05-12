<?php

namespace App\Console\Commands;

use App\Models\Car;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckCarNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-car-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check cars for notification triggers like repair phase duration, dealership phase duration, and budget exceeded';

    /**
     * The notification service instance.
     *
     * @var \App\Services\NotificationService
     */
    protected $notificationService;

    /**
     * Create a new command instance.
     *
     * @param \App\Services\NotificationService $notificationService
     * @return void
     */
    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking cars for notification triggers...');

        $this->checkRepairPhase();
        $this->checkDealershipPhase();
        $this->checkBudgetExceeded();

        $this->info('Notification check completed.');
    }

    /**
     * Check cars in repair phase.
     *
     * @return void
     */
    protected function checkRepairPhase()
    {
        $this->info('Checking cars in repair phase...');

        // Get cars in repair phase
        $cars = Car::where('phase', 'repair')
            ->whereNotNull('repair_start_date')
            ->get();

        $count = 0;

        foreach ($cars as $car) {
            $days = now()->diffInDays($car->repair_start_date);

            // Get the car owner
            $user = User::find($car->user_id);

            if (!$user || !$user->preferences) {
                continue;
            }

            // Check if days exceed the threshold
            if ($days >= $user->preferences->repair_phase_days_threshold) {
                $notification = $this->notificationService->createRepairPhaseAlert($user, $car, $days);

                if ($notification) {
                    $count++;
                }
            }
        }

        $this->info("Sent {$count} repair phase notifications.");
    }

    /**
     * Check cars in dealership phase.
     *
     * @return void
     */
    protected function checkDealershipPhase()
    {
        $this->info('Checking cars in dealership phase...');

        // Get cars in dealership phase
        $cars = Car::where('phase', 'dealership')
            ->whereNotNull('dealership_start_date')
            ->get();

        $count = 0;

        foreach ($cars as $car) {
            $days = now()->diffInDays($car->dealership_start_date);

            // Get the car owner
            $user = User::find($car->user_id);

            if (!$user || !$user->preferences) {
                continue;
            }

            // Check if days exceed the threshold
            if ($days >= $user->preferences->dealership_phase_days_threshold) {
                $notification = $this->notificationService->createDealershipPhaseAlert($user, $car, $days);

                if ($notification) {
                    $count++;
                }
            }
        }

        $this->info("Sent {$count} dealership phase notifications.");
    }

    /**
     * Check cars with exceeded repair budget.
     *
     * @return void
     */
    protected function checkBudgetExceeded()
    {
        $this->info('Checking cars with exceeded repair budget...');

        // Get cars in repair phase with estimated repair cost
        $cars = Car::whereIn('phase', ['repair', 'dealership'])
            ->whereNotNull('estimated_repair_cost')
            ->where('estimated_repair_cost', '>', 0)
            ->get();

        $count = 0;

        foreach ($cars as $car) {
            // Calculate the percentage exceeded
            $percentage = 0;

            if ($car->estimated_repair_cost > 0) {
                $percentage = (($car->total_repair_cost - $car->estimated_repair_cost) / $car->estimated_repair_cost) * 100;
            }

            // Only proceed if budget is exceeded
            if ($percentage <= 0) {
                continue;
            }

            // Get the car owner
            $user = User::find($car->user_id);

            if (!$user || !$user->preferences) {
                continue;
            }

            // Check if percentage exceeds the threshold
            if ($percentage >= $user->preferences->budget_exceeded_percentage) {
                $notification = $this->notificationService->createBudgetExceededAlert($user, $car, $percentage);

                if ($notification) {
                    $count++;
                }
            }
        }

        $this->info("Sent {$count} budget exceeded notifications.");
    }
}
