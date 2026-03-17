<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\Ctc\ServiceController;
use App\Http\Controllers\Admin\Ctc\ClinicController;
use App\Http\Controllers\Admin\Ctc\FacilityController;
use App\Http\Controllers\Admin\CareerController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout')->middleware('auth');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::post('pages/sync', [PageController::class, 'sync'])->name('pages.sync');
    Route::resource('pages', PageController::class)->except(['show']);
    Route::post('pages/{page}/sections', [PageController::class, 'storeSection'])->name('pages.sections.store');
    Route::put('pages/{page}/sections/{section}', [PageController::class, 'updateSection'])->name('pages.sections.update');
    Route::delete('pages/{page}/sections/{section}', [PageController::class, 'destroySection'])->name('pages.sections.destroy');
    Route::post('pages/{page}/sections/reorder', [PageController::class, 'reorderSections'])->name('pages.sections.reorder');
    Route::post('pages/{page}/sections/{section}/move/{direction}', [PageController::class, 'moveSection'])->name('pages.sections.move')->where('direction', 'up|down');
    Route::get('media', [MediaController::class, 'index'])->name('media.index');
    Route::post('media', [MediaController::class, 'store'])->name('media.store');
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('menus', [MenuController::class, 'index'])->name('menus.index');
    Route::post('menus/items', [MenuController::class, 'storeItem'])->name('menus.items.store');
    Route::put('menus/items/{item}', [MenuController::class, 'updateItem'])->name('menus.items.update');
    Route::delete('menus/items/{item}', [MenuController::class, 'destroyItem'])->name('menus.items.destroy');
    Route::post('menus/items/{item}/duplicate', [MenuController::class, 'duplicateItem'])->name('menus.items.duplicate');
    Route::post('menus/reorder', [MenuController::class, 'reorder'])->name('menus.reorder');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::resource('careers', CareerController::class)->except(['show']);
    Route::prefix('ctc')->name('ctc.')->group(function () {
        Route::get('services', [ServiceController::class, 'index'])->name('services.index');
        Route::get('clinics', [ClinicController::class, 'index'])->name('clinics.index');
        Route::get('facilities', [FacilityController::class, 'index'])->name('facilities.index');
    });
});
