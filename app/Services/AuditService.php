<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditService
{
    /**
     * Log a create action.
     *
     * @param Model $model The model that was created
     * @return AuditLog
     */
    public static function logCreated(Model $model): AuditLog
    {
        return self::log('created', $model, null, $model->getAttributes());
    }

    /**
     * Log an update action.
     *
     * @param Model $model The model that was updated
     * @param array $oldValues The old values before update
     * @return AuditLog
     */
    public static function logUpdated(Model $model, array $oldValues): AuditLog
    {
        return self::log('updated', $model, $oldValues, $model->getAttributes());
    }

    /**
     * Log a delete action.
     *
     * @param Model $model The model that was deleted
     * @return AuditLog
     */
    public static function logDeleted(Model $model): AuditLog
    {
        return self::log('deleted', $model, $model->getAttributes(), null);
    }

    /**
     * Log a soft delete action.
     *
     * @param Model $model The model that was soft deleted
     * @param int|null $userId The ID of the user performing the action
     * @return AuditLog
     */
    public static function logSoftDeleted(Model $model, ?int $userId = null): AuditLog
    {
        return self::log('soft_deleted', $model, $model->getAttributes(), null, $userId);
    }

    /**
     * Log a restore action.
     *
     * @param Model $model The model that was restored
     * @param int|null $userId The ID of the user performing the action
     * @return AuditLog
     */
    public static function logRestored(Model $model, ?int $userId = null): AuditLog
    {
        return self::log('restored', $model, null, $model->getAttributes(), $userId);
    }

    /**
     * Log a login action.
     *
     * @param Model $user The user that logged in
     * @return AuditLog
     */
    public static function logLogin(Model $user): AuditLog
    {
        return self::log('login', $user, null, null);
    }

    /**
     * Log a logout action.
     *
     * @param Model $user The user that logged out
     * @return AuditLog
     */
    public static function logLogout(Model $user): AuditLog
    {
        return self::log('logout', $user, null, null);
    }

    /**
     * Log a custom action.
     *
     * @param string $action The action name
     * @param Model $model The model affected
     * @param array|null $oldValues The old values (if applicable)
     * @param array|null $newValues The new values (if applicable)
     * @param int|null $userId The ID of the user performing the action (defaults to current authenticated user)
     * @return AuditLog
     */
    public static function log(string $action, Model $model, ?array $oldValues = null, ?array $newValues = null, ?int $userId = null): AuditLog
    {
        // Filter out sensitive data
        if ($oldValues) {
            $oldValues = self::filterSensitiveData($oldValues, $model);
        }

        if ($newValues) {
            $newValues = self::filterSensitiveData($newValues, $model);
        }

        // Use provided user ID or fall back to current authenticated user
        $userId ??= Auth::id();

        return AuditLog::create([
            'user_id' => $userId,
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /**
     * Filter out sensitive data from the values.
     *
     * @param array $values The values to filter
     * @param Model $model The model being audited
     * @return array
     */
    protected static function filterSensitiveData(array $values, Model $model): array
    {
        $sensitiveFields = ['password', 'remember_token', 'api_token'];

        // If the model has a getSensitiveFields method, use that
        if (method_exists($model, 'getSensitiveFields')) {
            $sensitiveFields = array_merge($sensitiveFields, $model->getSensitiveFields());
        }

        foreach ($sensitiveFields as $field) {
            if (isset($values[$field])) {
                $values[$field] = '******';
            }
        }

        return $values;
    }
}
