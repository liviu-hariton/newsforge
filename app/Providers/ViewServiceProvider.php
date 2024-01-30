<?php

namespace App\Providers;

use App\View\Composers\ContactMenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['backend.contact.blocks.menu', 'backend.contact.index', 'backend.contact.show'], ContactMenuComposer::class);
    }
}
