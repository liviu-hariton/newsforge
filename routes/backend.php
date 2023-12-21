<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingsGeneralController;
use Illuminate\Support\Facades\Route;

/*
 * Ajax calls
 */
Route::post('load-mailer-form-fields', [SettingsGeneralController::class, 'loadMailerFormFields'])->name('load.mailer.form.fields');

/*
 * Backend sections
 */
Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('settings/general', [SettingsGeneralController::class, 'index'])->name('settings.general');
Route::patch('settings/general', [SettingsGeneralController::class, 'store'])->name('settings.general.store');
Route::delete('settings/general', [SettingsGeneralController::class, 'reset'])->name('settings.general.reset');
