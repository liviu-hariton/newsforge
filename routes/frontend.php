<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
 * Ajax calls
 */



/*
 * Frontend sections
 */

// Authentication
Auth::routes();

// Homepage
Route::get('/', [HomeController::class, 'home'])->name('home');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::put('/contact', [ContactController::class, 'store'])->name('contact.store');

// User account
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->as('user.')
    ->group(
        function() {
            Route::get('/', [UserDashboardController::class, 'dashboard'])->name('dashboard');
        }
);
