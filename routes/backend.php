<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingsGeneralController;
use Illuminate\Support\Facades\Route;

/*
 * Ajax calls
 */
Route::patch('change-attribute', [BackendController::class, 'changeAttribute'])->name('change-attribute');
Route::put('update-sort-order', [BackendController::class, 'setSortOrder'])->name('update-sort-order');
Route::put('inline-edit', [BackendController::class, 'inlineEdit'])->name('inline-edit');
Route::post('load-mailer-form-fields', [SettingsGeneralController::class, 'loadMailerFormFields'])->name('load.mailer.form.fields');
Route::delete('settings/delete-contact-method/{data}', [SettingsGeneralController::class, 'deleteContactMethod'])->name('settings.delete.contact.method');
Route::put('update-contact-option-map', [SettingsGeneralController::class, 'saveContactOptionMap'])->name('update-contact-option-map');

/*
 * Backend sections
 */
// Dashboard
Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

// General settings
Route::get('settings/general', [SettingsGeneralController::class, 'index'])->name('settings.general');
Route::patch('settings/general', [SettingsGeneralController::class, 'store'])->name('settings.general.store');
Route::delete('settings/general', [SettingsGeneralController::class, 'reset'])->name('settings.general.reset');
Route::put('settings/add-contact-method', [SettingsGeneralController::class, 'storeContactMethod'])->name('settings.add.contact.method');
