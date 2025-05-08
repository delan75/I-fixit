<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogService
{
    /**
     * Log a user login activity.
     *
     * @param Model $user The user that logged in
     * @return ActivityLog
     */
    public static function logLogin(Model $user): ActivityLog
    {
        return self::log(
            'login',
            'User logged in',
            $user,
            null,
            $user->id
        );
    }

    /**
     * Log a user logout activity.
     *
     * @param Model $user The user that logged out
     * @return ActivityLog
     */
    public static function logLogout(Model $user): ActivityLog
    {
        return self::log(
            'logout',
            'User logged out',
            $user,
            null,
            $user->id
        );
    }

    /**
     * Log a resource view activity.
     *
     * @param string $resourceType The type of resource being viewed
     * @param Model $model The model being viewed
     * @param string|null $userId The ID of the user performing the action
     * @return ActivityLog
     */
    public static function logView(string $resourceType, Model $model, ?string $userId = null): ActivityLog
    {
        return self::log(
            'view',
            "Viewed {$resourceType} #{$model->getKey()}",
            $model,
            null,
            $userId
        );
    }

    /**
     * Log a resource creation activity.
     *
     * @param string $resourceType The type of resource being created
     * @param Model $model The model that was created
     * @param string|null $userId The ID of the user performing the action
     * @return ActivityLog
     */
    public static function logCreate(string $resourceType, Model $model, ?string $userId = null): ActivityLog
    {
        return self::log(
            'create',
            "Created {$resourceType} #{$model->getKey()}",
            $model,
            null,
            $userId
        );
    }

    /**
     * Log a resource update activity.
     *
     * @param string $resourceType The type of resource being updated
     * @param Model $model The model that was updated
     * @param string|null $userId The ID of the user performing the action
     * @return ActivityLog
     */
    public static function logUpdate(string $resourceType, Model $model, ?string $userId = null): ActivityLog
    {
        return self::log(
            'update',
            "Updated {$resourceType} #{$model->getKey()}",
            $model,
            null,
            $userId
        );
    }

    /**
     * Log a resource deletion activity.
     *
     * @param string $resourceType The type of resource being deleted
     * @param Model $model The model that was deleted
     * @param string|null $userId The ID of the user performing the action
     * @return ActivityLog
     */
    public static function logDelete(string $resourceType, Model $model, ?string $userId = null): ActivityLog
    {
        return self::log(
            'delete',
            "Deleted {$resourceType} #{$model->getKey()}",
            $model,
            null,
            $userId
        );
    }

    /**
     * Log a custom activity.
     *
     * @param string $activityType The type of activity
     * @param string $description A description of the activity
     * @param Model|null $model The related model (if applicable)
     * @param array|null $additionalData Additional data to log
     * @param string|null $userId The ID of the user performing the action
     * @return ActivityLog
     */
    public static function log(
        string $activityType,
        string $description,
        ?Model $model = null,
        ?array $additionalData = null,
        ?string $userId = null
    ): ActivityLog {
        // Use provided user ID or fall back to current authenticated user
        $userId ??= Auth::id();

        $data = [
            'user_id' => $userId,
            'activity_type' => $activityType,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ];

        if ($model) {
            $data['model_type'] = get_class($model);
            $data['model_id'] = $model->getKey();
        }

        return ActivityLog::create($data);
    }
}
