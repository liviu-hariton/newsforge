<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
 * Ajax calls
 */



/*
 * Frontend sections
 */
// Email verification
Route::get('/email/verify', function () {
    return view('auth.frontend-verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('user.dashboard')->with('success', 'Welcome aboard! Your email address is confirmed!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// Authentication
Auth::routes();

// Homepage
Route::get('/', [HomeController::class, 'home'])->name('home');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::put('/contact', [ContactController::class, 'store'])->name('contact.store');

// User account
Route::middleware(['auth', 'verified', 'role:user'])
    ->prefix('user')
    ->as('user.')
    ->group(
        function() {
            Route::get('/', [UserDashboardController::class, 'dashboard'])->name('dashboard');
        }
);
