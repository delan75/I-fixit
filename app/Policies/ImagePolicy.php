<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ImagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Image $image): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Image $image): bool
    {
        // Admin can update any image
        if ($user->role === 'admin') {
            return true;
        }

        // Regular users can only update images they created
        return $image->created_by === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Image $image): bool
    {
        // Only admin can permanently delete
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Image $image): bool
    {
        // Only admin can restore
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Image $image): bool
    {
        // Only admin can permanently delete
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can soft delete the model.
     */
    public function softDelete(User $user, Image $image): bool
    {
        // Admin can soft delete any image
        if ($user->role === 'admin') {
            return true;
        }

        // Regular users can only soft delete images they created
        return $image->created_by === $user->id;
    }
}
