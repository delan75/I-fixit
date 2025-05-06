<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\DamagedPart;
use App\Models\Supplier;
use App\Models\User;
use App\Policies\CarPolicy;
use App\Policies\DamagedPartPolicy;
use App\Policies\SupplierPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Car::class => CarPolicy::class,
        DamagedPart::class => DamagedPartPolicy::class,
        Supplier::class => SupplierPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Register the policies
        $this->registerPolicies();

        // Define custom gates for soft delete
        Gate::define('soft-delete', function (User $user, $model) {
            return $user->hasRole('admin') || $user->id === $model->created_by;
        });

        // Define a gate for viewing users (admin only)
        Gate::define('view-users', function (User $user) {
            return $user->hasRole('admin');
        });

        // Define a gate for admin-only actions
        Gate::define('admin-action', function (User $user) {
            return $user->hasRole('admin');
        });
    }
}
