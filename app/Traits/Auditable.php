<?php

namespace App\Traits;

use App\Services\AuditService;

trait Auditable
{
    /**
     * Static property to store original values for each model
     */
    protected static $originalValues = [];

    /**
     * Boot the trait.
     */
    protected static function bootAuditable()
    {
        // Log model creation
        static::created(function ($model) {
            AuditService::logCreated($model);
        });

        // Log model updates
        static::updating(function ($model) {
            // Store the original values before they're updated in a static array
            // using the model's key as the array key
            static::$originalValues[$model->getKey()] = $model->getOriginal();
        });

        static::updated(function ($model) {
            if (isset(static::$originalValues[$model->getKey()])) {
                AuditService::logUpdated($model, static::$originalValues[$model->getKey()]);
                unset(static::$originalValues[$model->getKey()]);
            }
        });

        // Log model deletion
        static::deleted(function ($model) {
            // Check if this is a soft delete
            if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {
                AuditService::logSoftDeleted($model);
            } else {
                AuditService::logDeleted($model);
            }
        });

        // Log model restoration (if using soft deletes)
        if (method_exists(static::class, 'restored')) {
            static::restored(function ($model) {
                AuditService::logRestored($model);
            });
        }
    }

    /**
     * Get the list of sensitive fields that should be masked in audit logs.
     *
     * @return array
     */
    public function getSensitiveFields(): array
    {
        return $this->sensitiveFields ?? [];
    }
}
