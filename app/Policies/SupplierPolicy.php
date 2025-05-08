<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SupplierPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view the supplier listing
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Supplier $supplier): bool
    {
        // Admin can view any supplier
        if ($user->role === 'admin') {
            return true;
        }

        // Regular users can only view suppliers they created
        return $supplier->created_by === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create suppliers
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Supplier $supplier): bool
    {
        // Admin can update any supplier
        if ($user->role === 'admin') {
            return true;
        }

        // Regular users can only update suppliers they created
        return $supplier->created_by === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Supplier $supplier): bool
    {
        // Only admin can permanently delete
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Supplier $supplier): bool
    {
        // Only admin can restore
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Supplier $supplier): bool
    {
        // Only admin can permanently delete
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can soft delete the model.
     */
    public function softDelete(User $user, Supplier $supplier): bool
    {
        // Admin can soft delete any supplier
        if ($user->role === 'admin') {
            return true;
        }

        // Regular users can only soft delete suppliers they created
        return $supplier->created_by === $user->id;
    }
}
