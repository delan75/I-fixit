<?php

namespace App\Services;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailNotificationService
{
    /**
     * Send a repair phase alert email.
     *
     * @param User $user
     * @param Car $car
     * @param int $days
     * @return bool
     */
    public function sendRepairPhaseAlert(User $user, Car $car, int $days): bool
    {
        if (!$user->preferences || !$user->preferences->notification_email || !$user->preferences->notification_repair_phase) {
            return false;
        }

        try {
            Mail::send('emails.notifications.repair_phase_alert', [
                'user' => $user,
                'car' => $car,
                'days' => $days,
                'title' => 'Car Repair Phase Alert',
                'actionUrl' => route('cars.show', $car),
                'actionText' => 'View Car Details',
            ], function ($message) use ($user, $car) {
                $message->to($user->email, $user->full_name)
                    ->subject('I-fixit: Car in Repair Phase for Extended Period');
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send repair phase alert email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send a dealership phase alert email.
     *
     * @param User $user
     * @param Car $car
     * @param int $days
     * @return bool
     */
    public function sendDealershipPhaseAlert(User $user, Car $car, int $days): bool
    {
        if (!$user->preferences || !$user->preferences->notification_email || !$user->preferences->notification_dealership_phase) {
            return false;
        }

        try {
            Mail::send('emails.notifications.dealership_phase_alert', [
                'user' => $user,
                'car' => $car,
                'days' => $days,
                'title' => 'Car at Dealership Alert',
                'actionUrl' => route('cars.show', $car),
                'actionText' => 'View Car Details',
            ], function ($message) use ($user, $car) {
                $message->to($user->email, $user->full_name)
                    ->subject('I-fixit: Car at Dealership for Extended Period');
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send dealership phase alert email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send a budget exceeded alert email.
     *
     * @param User $user
     * @param Car $car
     * @param float $percentage
     * @return bool
     */
    public function sendBudgetExceededAlert(User $user, Car $car, float $percentage): bool
    {
        if (!$user->preferences || !$user->preferences->notification_email || !$user->preferences->notification_budget_exceeded) {
            return false;
        }

        try {
            Mail::send('emails.notifications.budget_exceeded_alert', [
                'user' => $user,
                'car' => $car,
                'percentage' => $percentage,
                'title' => 'Repair Budget Exceeded Alert',
                'actionUrl' => route('cars.show', $car),
                'actionText' => 'View Car Details',
            ], function ($message) use ($user, $car) {
                $message->to($user->email, $user->full_name)
                    ->subject('I-fixit: Repair Budget Exceeded');
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send budget exceeded alert email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send an opportunity alert email.
     *
     * @param User $user
     * @param object $opportunity
     * @return bool
     */
    public function sendOpportunityAlert(User $user, object $opportunity): bool
    {
        if (!$user->preferences || !$user->preferences->notification_email || !$user->preferences->notification_opportunity) {
            return false;
        }

        try {
            Mail::send('emails.notifications.opportunity_alert', [
                'user' => $user,
                'opportunity' => $opportunity,
                'title' => 'Investment Opportunity Alert',
                'actionUrl' => route('dashboard'),
                'actionText' => 'View Dashboard',
            ], function ($message) use ($user, $opportunity) {
                $message->to($user->email, $user->full_name)
                    ->subject('I-fixit: New Investment Opportunity');
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send opportunity alert email: ' . $e->getMessage());
            return false;
        }
    }
}
