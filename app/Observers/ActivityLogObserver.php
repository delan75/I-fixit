<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLogObserver
{
    /**
     * Handle the Model "created" event.
     */
    public function created(Model $model): void
    {
        // Skip logging for ActivityLog models to prevent infinite loops
        if ($model instanceof ActivityLog) {
            return;
        }

        $user = Auth::user();
        if ($user) {
            $modelName = class_basename($model);
            ActivityLogService::logCreate($modelName, $model, $user->id);
        }
    }

    /**
     * Handle the Model "updated" event.
     */
    public function updated(Model $model): void
    {
        // Skip logging for ActivityLog models to prevent infinite loops
        if ($model instanceof ActivityLog) {
            return;
        }

        $user = Auth::user();
        if ($user) {
            $modelName = class_basename($model);
            ActivityLogService::logUpdate($modelName, $model, $user->id);
        }
    }

    /**
     * Handle the Model "deleted" event.
     */
    public function deleted(Model $model): void
    {
        // Skip logging for ActivityLog models to prevent infinite loops
        if ($model instanceof ActivityLog) {
            return;
        }

        $user = Auth::user();
        if ($user) {
            $modelName = class_basename($model);
            ActivityLogService::logDelete($modelName, $model, $user->id);
        }
    }

    /**
     * Handle the Model "restored" event.
     */
    public function restored(Model $model): void
    {
        // Skip logging for ActivityLog models to prevent infinite loops
        if ($model instanceof ActivityLog) {
            return;
        }

        $user = Auth::user();
        if ($user) {
            $modelName = class_basename($model);
            ActivityLogService::log('restore', "Restored {$modelName} #{$model->getKey()}", $model, null, $user->id);
        }
    }

    /**
     * Handle the Model "force deleted" event.
     */
    public function forceDeleted(Model $model): void
    {
        // Skip logging for ActivityLog models to prevent infinite loops
        if ($model instanceof ActivityLog) {
            return;
        }

        $user = Auth::user();
        if ($user) {
            $modelName = class_basename($model);
            ActivityLogService::log('force_delete', "Force deleted {$modelName} #{$model->getKey()}", $model, null, $user->id);
        }
    }
}
