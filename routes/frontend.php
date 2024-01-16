<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

Auth::routes();

/*
 * Ajax calls
 */



/*
 * Frontend sections
 */
// Homepage
Route::get('/', [HomeController::class, 'home'])->name('home');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::put('/contact', [ContactController::class, 'store'])->name('contact.store');
