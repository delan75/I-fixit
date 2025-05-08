<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin or superuser can view the user listing
        return $user->hasAdminAccess();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Superuser can view any user
        if ($user->isSuperuser()) {
            return true;
        }

        // Admin can view any user except superusers
        if ($user->isAdmin()) {
            return !$model->isSuperuser();
        }

        // Regular users can only view their own profile
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admin or superuser can create users
        return $user->hasAdminAccess();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // Superuser can update any user
        if ($user->isSuperuser()) {
            return true;
        }

        // Admin can update any user except superusers
        if ($user->isAdmin()) {
            return !$model->isSuperuser();
        }

        // Regular users can only update their own profile
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Superuser can delete any user
        if ($user->isSuperuser()) {
            return true;
        }

        // Admin can delete any user except superusers
        if ($user->isAdmin()) {
            return !$model->isSuperuser();
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        // Superuser can restore any user
        if ($user->isSuperuser()) {
            return true;
        }

        // Admin can restore any user except superusers
        if ($user->isAdmin()) {
            return !$model->isSuperuser();
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        // Only superuser can permanently delete users
        return $user->isSuperuser();
    }

    /**
     * Determine whether the user can soft delete the model.
     */
    public function softDelete(User $user, User $model): bool
    {
        // Prevent users from soft deleting themselves
        if ($user->id === $model->id) {
            return false;
        }

        // Superuser can soft delete any user
        if ($user->isSuperuser()) {
            return true;
        }

        // Admin can soft delete any user except superusers
        if ($user->isAdmin()) {
            return !$model->isSuperuser();
        }

        return false;
    }
}
