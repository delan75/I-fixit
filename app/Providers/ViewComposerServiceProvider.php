<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share unread contact messages count with navigation views
        View::composer(['layouts.navigation'], function ($view) {
            $unreadContactCount = 0;
            
            if (Auth::check() && Auth::user()->hasAdminAccess()) {
                $unreadContactCount = Contact::where('is_read', false)->count();
            }
            
            $view->with('unreadContactCount', $unreadContactCount);
        });
    }
}
