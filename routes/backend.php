<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingsGeneralController;
use Illuminate\Support\Facades\Route;

// Authentication
Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::middleware(['auth', 'role:admin'])->group(function() {
    /*
     * Ajax calls
     */
    Route::patch('change-attribute', [BackendController::class, 'changeAttribute'])->name('change-attribute');
    Route::put('update-sort-order', [BackendController::class, 'setSortOrder'])->name('update-sort-order');
    Route::put('inline-edit', [BackendController::class, 'inlineEdit'])->name('inline-edit');
    Route::post('load-mailer-form-fields', [SettingsGeneralController::class, 'loadMailerFormFields'])->name('load.mailer.form.fields');
    Route::delete('settings/delete-contact-method/{data}', [SettingsGeneralController::class, 'deleteContactMethod'])->name('settings.delete.contact.method');
    Route::delete('settings/delete-contact-field/{data}', [SettingsGeneralController::class, 'deleteContactField'])->name('settings.delete.contact.field');
    Route::put('update-contact-option-map', [SettingsGeneralController::class, 'saveContactOptionMap'])->name('update-contact-option-map');
    Route::put('update-contact-map', [SettingsGeneralController::class, 'saveContactMap'])->name('update-contact-map');
    Route::patch('update-setting-value', [SettingsGeneralController::class, 'saveSettingValue'])->name('update-setting-value');

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
    Route::put('settings/add-contact-field', [SettingsGeneralController::class, 'storeContactField'])->name('settings.add.contact.field');
});
