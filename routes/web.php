<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\IsoDocumentController;
use App\Http\Controllers\BackupFileController;
use App\Http\Controllers\TestEquipmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clc', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";
});

// Default Redirect
Route::get('/', fn() => redirect('/admin/job'));
Route::get('/admin/job', [UserController::class, 'index']);

// Admin Routes Group
Route::prefix('admin')->group(function () {

    // Login/Register
    Route::controller(AuthController::class)->middleware('loggedin')->group(function () {
        Route::get('login', 'loginView')->name('login.index');
        Route::post('login', 'login')->name('login.check');
        Route::get('register', 'registerView')->name('register.index');
        Route::post('register', 'register')->name('register.store');
    });

    // Theme Switchers
    Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
    Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

    // Job Management
    Route::get('/job', [UserController::class, 'index'])->name('job.index');
    Route::get('/job/create', [JobController::class, 'create'])->name('job.create');

    // Project Reports & Visualizations
    Route::view('/project-status-report', 'admin.project_status_report.index')->name('project-status-report.index');
    Route::view('/project-visualization', 'admin.project_visualization.index')->name('project-visualization.index');

    // Test Equipment
    Route::get('/test-equipment', [TestEquipmentController::class, 'index'])->name('test-equipment.index');
    Route::get('/test-equipment/create', [TestEquipmentController::class, 'createEquipment']);
    Route::post('/test-equipment', [TestEquipmentController::class, 'store']);
    Route::get('/test-equipment/{id}/edit', [TestEquipmentController::class, 'edit'])->name('test-equipment.edit');
    Route::put('/test-equipment/{id}', [TestEquipmentController::class, 'update'])->name('test-equipment.update');
    Route::delete('/test-equipment/{id}', [TestEquipmentController::class, 'destroy'])->name('test-equipment.destroy');

    // ISO Documents
    Route::view('/iso-documents', 'admin.iso_documents.index')->name('iso-documents.index');
    Route::get('/iso-documents/manage/{key}', [IsoDocumentController::class, 'manage'])->name('iso-documents.manage');

    // Lab Availability
    Route::view('/lab-availability', 'admin.lab_availability.index')->name('lab-availability.index');

    // Backup File System
    Route::prefix('backup-file')->name('backup-file.')->group(function () {
        Route::get('/create-folder', [BackupFileController::class, 'create'])->name('create-folder');
        Route::post('/store', [BackupFileController::class, 'store'])->name('store');
        Route::get('/upload-file', [BackupFileController::class, 'createFile'])->name('upload-file');
        Route::post('/upload-file', [BackupFileController::class, 'storeFile'])->name('upload-file.store');
        Route::get('/{parentId?}', [BackupFileController::class, 'index'])->name('index');
    });
});

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');