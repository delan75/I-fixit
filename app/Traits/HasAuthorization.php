<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasAuthorization
{
    /**
     * Boot the trait.
     */
    protected static function bootHasAuthorization()
    {
        // Set created_by and updated_by on create
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        // Set updated_by on update
        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }

    /**
     * Get the user that created the model.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that last updated the model.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope a query to only include records created by a specific user.
     */
    public function scopeCreatedBy(Builder $query, $userId)
    {
        return $query->where('created_by', $userId);
    }

    /**
     * Scope a query to only include active records.
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include inactive records.
     */
    public function scopeInactive(Builder $query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Scope a query to only include records the current user has access to.
     * Admin users can see all records, regular users can only see their own.
     */
    public function scopeAccessibleBy(Builder $query, User $user = null)
    {
        $user = $user ?? Auth::user();

        if (!$user) {
            return $query;
        }

        if ($user->role === 'admin') {
            return $query;
        }

        return $query->where('created_by', $user->id);
    }

    /**
     * Mark the model as inactive (soft delete).
     */
    public function markAsInactive()
    {
        $this->status = 'inactive';
        $this->save();

        return $this;
    }

    /**
     * Mark the model as active.
     */
    public function markAsActive()
    {
        $this->status = 'active';
        $this->save();

        return $this;
    }
}
