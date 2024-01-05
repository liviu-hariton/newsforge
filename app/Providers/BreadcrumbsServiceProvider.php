<?php

namespace App\Providers;

use App\Services\BreadcrumbsService;
use Blade;
use Illuminate\Support\ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register any services or bindings if needed
        $this->app->bind('breadcrumbs', function () {
            return new BreadcrumbsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('breadcrumbs', function ($expression) {
            return "<?php echo app('breadcrumbs')->render($expression); ?>";
        });
    }
}
