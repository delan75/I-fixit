<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * The email notification service instance.
     *
     * @var \App\Services\EmailNotificationService
     */
    protected $emailNotificationService;

    /**
     * Create a new notification service instance.
     *
     * @param \App\Services\EmailNotificationService $emailNotificationService
     * @return void
     */
    public function __construct(EmailNotificationService $emailNotificationService)
    {
        $this->emailNotificationService = $emailNotificationService;
    }
    /**
     * Create a new notification.
     *
     * @param User|string $user User instance or user ID
     * @param string $type Notification type
     * @param string $title Notification title
     * @param string $message Notification message
     * @param array|null $data Additional data
     * @param string|null $icon Icon class (e.g., 'fa-bell')
     * @param string|null $link URL to redirect when notification is clicked
     * @return Notification
     */
    public function create($user, string $type, string $title, string $message, ?array $data = null, ?string $icon = null, ?string $link = null): Notification
    {
        // Get user ID if a User instance was provided
        $userId = $user instanceof User ? $user->id : $user;

        // Create the notification
        $notification = Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
            'icon' => $icon,
            'link' => $link,
            'is_read' => false,
        ]);

        // Broadcast the notification
        $this->broadcast($notification);

        return $notification;
    }

    /**
     * Create a notification for the current user.
     *
     * @param string $type Notification type
     * @param string $title Notification title
     * @param string $message Notification message
     * @param array|null $data Additional data
     * @param string|null $icon Icon class (e.g., 'fa-bell')
     * @param string|null $link URL to redirect when notification is clicked
     * @return Notification|null
     */
    public function createForCurrentUser(string $type, string $title, string $message, ?array $data = null, ?string $icon = null, ?string $link = null): ?Notification
    {
        if (Auth::check()) {
            return $this->create(Auth::id(), $type, $title, $message, $data, $icon, $link);
        }

        return null;
    }

    /**
     * Create a notification for multiple users.
     *
     * @param array $userIds Array of user IDs
     * @param string $type Notification type
     * @param string $title Notification title
     * @param string $message Notification message
     * @param array|null $data Additional data
     * @param string|null $icon Icon class (e.g., 'fa-bell')
     * @param string|null $link URL to redirect when notification is clicked
     * @return array Array of created notifications
     */
    public function createForMultipleUsers(array $userIds, string $type, string $title, string $message, ?array $data = null, ?string $icon = null, ?string $link = null): array
    {
        $notifications = [];

        foreach ($userIds as $userId) {
            $notifications[] = $this->create($userId, $type, $title, $message, $data, $icon, $link);
        }

        return $notifications;
    }

    /**
     * Create a notification for all users with a specific role.
     *
     * @param string $role Role name (e.g., 'admin')
     * @param string $type Notification type
     * @param string $title Notification title
     * @param string $message Notification message
     * @param array|null $data Additional data
     * @param string|null $icon Icon class (e.g., 'fa-bell')
     * @param string|null $link URL to redirect when notification is clicked
     * @return array Array of created notifications
     */
    public function createForRole(string $role, string $type, string $title, string $message, ?array $data = null, ?string $icon = null, ?string $link = null): array
    {
        $users = User::where('role', $role)->get();
        $notifications = [];

        foreach ($users as $user) {
            $notifications[] = $this->create($user, $type, $title, $message, $data, $icon, $link);
        }

        return $notifications;
    }

    /**
     * Create a notification for all users.
     *
     * @param string $type Notification type
     * @param string $title Notification title
     * @param string $message Notification message
     * @param array|null $data Additional data
     * @param string|null $icon Icon class (e.g., 'fa-bell')
     * @param string|null $link URL to redirect when notification is clicked
     * @return array Array of created notifications
     */
    public function createForAllUsers(string $type, string $title, string $message, ?array $data = null, ?string $icon = null, ?string $link = null): array
    {
        $users = User::all();
        $notifications = [];

        foreach ($users as $user) {
            $notifications[] = $this->create($user, $type, $title, $message, $data, $icon, $link);
        }

        return $notifications;
    }

    /**
     * Mark a notification as read.
     *
     * @param Notification|int $notification Notification instance or ID
     * @return Notification
     */
    public function markAsRead($notification): Notification
    {
        if (!$notification instanceof Notification) {
            $notification = Notification::findOrFail($notification);
        }

        return $notification->markAsRead();
    }

    /**
     * Mark all notifications as read for a user.
     *
     * @param User|string|null $user User instance or ID (defaults to current user)
     * @return int Number of notifications marked as read
     */
    public function markAllAsRead($user = null): int
    {
        $userId = null;

        if ($user instanceof User) {
            $userId = $user->id;
        } elseif (is_string($user)) {
            $userId = $user;
        } elseif (Auth::check()) {
            $userId = Auth::id();
        }

        if ($userId) {
            return Notification::where('user_id', $userId)
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now(),
                ]);
        }

        return 0;
    }

    /**
     * Broadcast a notification to the user's private channel.
     *
     * @param Notification $notification
     * @return void
     */
    protected function broadcast(Notification $notification): void
    {
        try {
            Broadcast::channel('App.Models.User.' . $notification->user_id, function ($user) use ($notification) {
                return (int) $user->id === (int) $notification->user_id;
            });

            event(new \App\Events\NewNotification($notification));
        } catch (\Exception $e) {
            Log::error('Failed to broadcast notification: ' . $e->getMessage());
        }
    }

    /**
     * Create a repair phase alert notification.
     *
     * @param User $user
     * @param Car $car
     * @param int $days
     * @return Notification|null
     */
    public function createRepairPhaseAlert(User $user, Car $car, int $days): ?Notification
    {
        // Check if user has app notifications enabled for repair phase
        if (!$user->preferences || !$user->preferences->notification_app || !$user->preferences->notification_repair_phase) {
            return null;
        }

        // Check if days exceed the threshold
        if ($days < $user->preferences->repair_phase_days_threshold) {
            return null;
        }

        // Create the notification
        $notification = $this->create(
            $user,
            'repair_phase_alert',
            'Car in Repair Phase for ' . $days . ' Days',
            'Your ' . $car->year . ' ' . $car->make . ' ' . $car->model . ' has been in the repair phase for ' . $days . ' days.',
            [
                'car_id' => $car->id,
                'days' => $days,
                'repair_cost' => $car->total_repair_cost,
            ],
            'fa-wrench',
            route('cars.show', $car)
        );

        // Send email notification if enabled
        $this->emailNotificationService->sendRepairPhaseAlert($user, $car, $days);

        return $notification;
    }

    /**
     * Create a dealership phase alert notification.
     *
     * @param User $user
     * @param Car $car
     * @param int $days
     * @return Notification|null
     */
    public function createDealershipPhaseAlert(User $user, Car $car, int $days): ?Notification
    {
        // Check if user has app notifications enabled for dealership phase
        if (!$user->preferences || !$user->preferences->notification_app || !$user->preferences->notification_dealership_phase) {
            return null;
        }

        // Check if days exceed the threshold
        if ($days < $user->preferences->dealership_phase_days_threshold) {
            return null;
        }

        // Create the notification
        $notification = $this->create(
            $user,
            'dealership_phase_alert',
            'Car at Dealership for ' . $days . ' Days',
            'Your ' . $car->year . ' ' . $car->make . ' ' . $car->model . ' has been at the dealership for ' . $days . ' days.',
            [
                'car_id' => $car->id,
                'days' => $days,
                'market_value' => $car->estimated_market_value,
                'investment' => $car->total_investment,
            ],
            'fa-store',
            route('cars.show', $car)
        );

        // Send email notification if enabled
        $this->emailNotificationService->sendDealershipPhaseAlert($user, $car, $days);

        return $notification;
    }

    /**
     * Create a budget exceeded alert notification.
     *
     * @param User $user
     * @param Car $car
     * @param float $percentage
     * @return Notification|null
     */
    public function createBudgetExceededAlert(User $user, Car $car, float $percentage): ?Notification
    {
        // Check if user has app notifications enabled for budget exceeded
        if (!$user->preferences || !$user->preferences->notification_app || !$user->preferences->notification_budget_exceeded) {
            return null;
        }

        // Check if percentage exceeds the threshold
        if ($percentage < $user->preferences->budget_exceeded_percentage) {
            return null;
        }

        // Create the notification
        $notification = $this->create(
            $user,
            'budget_exceeded_alert',
            'Repair Budget Exceeded by ' . number_format($percentage, 1) . '%',
            'The repair costs for your ' . $car->year . ' ' . $car->make . ' ' . $car->model . ' have exceeded the estimated budget by ' . number_format($percentage, 1) . '%.',
            [
                'car_id' => $car->id,
                'percentage' => $percentage,
                'estimated_cost' => $car->estimated_repair_cost,
                'actual_cost' => $car->total_repair_cost,
            ],
            'fa-exclamation-triangle',
            route('cars.show', $car)
        );

        // Send email notification if enabled
        $this->emailNotificationService->sendBudgetExceededAlert($user, $car, $percentage);

        return $notification;
    }

    /**
     * Create an opportunity alert notification.
     *
     * @param User $user
     * @param object $opportunity
     * @return Notification|null
     */
    public function createOpportunityAlert(User $user, object $opportunity): ?Notification
    {
        // Check if user has app notifications enabled for opportunities
        if (!$user->preferences || !$user->preferences->notification_app || !$user->preferences->notification_opportunity) {
            return null;
        }

        // Create the notification
        $notification = $this->create(
            $user,
            'opportunity_alert',
            'New Investment Opportunity',
            'A ' . $opportunity->year . ' ' . $opportunity->make . ' ' . $opportunity->model . ' with a score of ' . $opportunity->score . '/100 is available.',
            [
                'opportunity' => $opportunity,
            ],
            'fa-chart-line',
            isset($opportunity->id) ? route('cars.show', $opportunity->id) : route('cars.index')
        );

        // Send email notification if enabled
        $this->emailNotificationService->sendOpportunityAlert($user, $opportunity);

        return $notification;
    }

    /**
     * Create an admin notification for user actions.
     *
     * @param string $action The action performed (created, updated, deleted)
     * @param string $resourceType The type of resource (car, supplier, etc.)
     * @param mixed $resourceId The ID of the resource
     * @param User $performer The user who performed the action
     * @param string|null $resourceName Optional name of the resource
     * @return void
     */
    public function notifyAdmins(string $action, string $resourceType, $resourceId, User $performer, ?string $resourceName = null): void
    {
        // Get all admin and superuser users
        $admins = User::where('role', 'admin')
            ->orWhere('is_superuser', true)
            ->where('id', '!=', $performer->id) // Don't notify the performer
            ->get();

        if ($admins->isEmpty()) {
            return;
        }

        // Determine the icon based on the action
        $icon = 'fa-info-circle';
        if ($action === 'created') {
            $icon = 'fa-plus-circle';
        } elseif ($action === 'updated') {
            $icon = 'fa-edit';
        } elseif ($action === 'deleted') {
            $icon = 'fa-trash';
        }

        // Determine the route based on the resource type
        $route = null;
        switch ($resourceType) {
            case 'car':
                $route = $action === 'deleted' ? route('cars.index') : route('cars.show', $resourceId);
                break;
            case 'supplier':
                $route = route('suppliers.index');
                break;
            case 'part':
                $route = route('cars.show', $resourceId);
                break;
            case 'labor':
                $route = route('cars.show', $resourceId);
                break;
            case 'painting':
                $route = route('cars.show', $resourceId);
                break;
            case 'sale':
                $route = route('cars.show', $resourceId);
                break;
            default:
                $route = route('dashboard');
                break;
        }

        // Create a title with proper capitalization
        $resourceTypeCapitalized = ucfirst($resourceType);
        $actionPast = $action === 'created' ? 'created' : ($action === 'updated' ? 'updated' : 'deleted');

        // Create a more descriptive message if resource name is provided
        $message = $performer->full_name . ' has ' . $actionPast . ' a ' . $resourceType;
        if ($resourceName) {
            $message = $performer->full_name . ' has ' . $actionPast . ' ' . $resourceType . ': ' . $resourceName;
        }

        // Notify each admin
        foreach ($admins as $admin) {
            // Skip if admin has disabled app notifications
            if ($admin->preferences && !$admin->preferences->notification_app) {
                continue;
            }

            $this->create(
                $admin,
                'admin_notification',
                $resourceTypeCapitalized . ' ' . ucfirst($actionPast),
                $message,
                [
                    'resource_type' => $resourceType,
                    'resource_id' => $resourceId,
                    'action' => $action,
                    'performer_id' => $performer->id,
                    'performer_name' => $performer->full_name,
                ],
                $icon,
                $route
            );
        }
    }
}
