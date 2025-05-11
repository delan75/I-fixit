<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

class NotificationService
{
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
}
