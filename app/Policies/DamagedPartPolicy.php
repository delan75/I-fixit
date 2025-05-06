<?php

namespace App\Policies;

use App\Models\DamagedPart;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DamagedPartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view damaged parts
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DamagedPart $damagedPart): bool
    {
        // Admin can view any damaged part
        if ($user->hasRole('admin')) {
            return true;
        }

        // Regular users can only view damaged parts they created
        return $damagedPart->created_by === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create damaged parts
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DamagedPart $damagedPart): bool
    {
        // Admin can update any damaged part
        if ($user->hasRole('admin')) {
            return true;
        }

        // Regular users can only update damaged parts they created
        return $damagedPart->created_by === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DamagedPart $damagedPart): bool
    {
        // Only admin can permanently delete
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DamagedPart $damagedPart): bool
    {
        // Only admin can restore
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DamagedPart $damagedPart): bool
    {
        // Only admin can permanently delete
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can soft delete the model.
     */
    public function softDelete(User $user, DamagedPart $damagedPart): bool
    {
        // Admin can soft delete any damaged part
        if ($user->hasRole('admin')) {
            return true;
        }

        // Regular users can only soft delete damaged parts they created
        return $damagedPart->created_by === $user->id;
    }
}
