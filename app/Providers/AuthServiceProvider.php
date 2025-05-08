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
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
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
            return $user->hasAdminAccess() || $user->id === $model->created_by;
        });

        // Define a gate for viewing users (admin only)
        Gate::define('view-users', function (User $user) {
            return $user->hasAdminAccess();
        });

        // Define a gate for admin-only actions
        Gate::define('admin-action', function (User $user) {
            return $user->hasAdminAccess();
        });

        // Define a gate for superuser-only actions
        Gate::define('superuser-action', function (User $user) {
            return $user->isSuperuser();
        });

        // Define a gate for managing activity logs (superuser only)
        Gate::define('view-activity-logs', function (User $user) {
            return $user->isSuperuser();
        });

        // Register event listeners for activity logging
        $this->registerActivityLogListeners();
    }

    /**
     * Register event listeners for activity logging.
     */
    protected function registerActivityLogListeners(): void
    {
        // Authentication events
        Event::listen(Login::class, function ($event) {
            \App\Services\ActivityLogService::logLogin($event->user);
        });

        Event::listen(Logout::class, function ($event) {
            if ($event->user) {
                \App\Services\ActivityLogService::logLogout($event->user);
            }
        });

        // We're using the ActivityLogObserver for model events instead of these event listeners
        // This prevents duplicate logging and potential infinite loops
    }
}
