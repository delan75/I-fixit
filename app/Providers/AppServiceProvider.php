<?php

namespace App\Providers;

use App\Helpers\CurrencyHelper;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register currency blade directives
        Blade::directive('zar', function ($expression) {
            return "<?php echo App\\Helpers\\CurrencyHelper::formatZAR($expression); ?>";
        });

        Blade::directive('zarSmart', function ($expression) {
            return "<?php echo App\\Helpers\\CurrencyHelper::formatZARSmart($expression); ?>";
        });
    }
}
