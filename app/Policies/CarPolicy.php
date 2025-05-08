<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CarPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view the car listing
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Car $car): bool
    {
        // Admin can view any car
        if ($user->role === 'admin') {
            return true;
        }

        // Regular users can only view cars they created
        return $car->created_by === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create cars
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Car $car): bool
    {
        // Admin can update any car
        if ($user->role === 'admin') {
            return true;
        }

        // Regular users can only update cars they created
        return $car->created_by === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Car $car): bool
    {
        // Only admin can permanently delete
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Car $car): bool
    {
        // Only admin can restore
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Car $car): bool
    {
        // Only admin can permanently delete
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can soft delete the model.
     */
    public function softDelete(User $user, Car $car): bool
    {
        // Admin can soft delete any car
        if ($user->role === 'admin') {
            return true;
        }

        // Regular users can only soft delete cars they created
        return $car->created_by === $user->id;
    }
}
