<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\UserController;

Route::get('/clc', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";
});

// Default Redirect
Route::get('/', fn() => redirect('/admin/dashboard'));
Route::get('/admin/dashboard', [UserController::class, 'index']);

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

    // ────── Dashboard ──────
    Route::view('/dashboard', 'admin.dashboard.index')->name('dashboard.index');

    // ────── Users / Roles / Permissions ──────
    Route::view('/users', 'admin.users.index')->name('users.index');
    Route::view('/roles', 'admin.roles.index')->name('roles.index');
    Route::view('/permissions', 'admin.permissions.index')->name('permissions.index');


    // ────── Products ──────
    Route::view('products', 'admin.products.index')->name('products.index');
    Route::get('products/create', function () {
        return view('admin.products.create');
    })->name('products.create');

    Route::post('admin/products/temp-upload', function (Illuminate\Http\Request $request) {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'temp_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('temp'), $filename);
            return response()->json(['filename' => $filename]);
        }
        return response()->json(['filename' => null]);
    });

    Route::view('product-categories', 'admin.product-categories.index')->name('product-categories.index');
    Route::view('product-claims', 'admin.product-claims.index')->name('product-claims.index');

    // ────── Customers / Suppliers ──────
    Route::view('customers', 'admin.customers.index')->name('customers.index');
    Route::view('suppliers', 'admin.suppliers.index')->name('suppliers.index');

    // ────── Inventory ──────
    Route::view('stock-in', 'admin.stock-in.index')->name('stock-in.index');
    Route::view('stock-out', 'admin.stock-out.index')->name('stock-out.index');
    Route::view('branch-transfer', 'admin.branch-transfer.index')->name('branch-transfer.index');

    // ────── Purchase / Sales ──────
    Route::view('purchase-orders', 'admin.purchase-orders.index')->name('purchase-orders.index');
    Route::view('sales', 'admin.sales.index')->name('sales.index');
    Route::view('quotations', 'admin.quotations.index')->name('quotations.index');

    // ────── Reports ──────
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::view('/', 'admin.reports.index')->name('index');
        Route::view('/sales', 'admin.reports.sales')->name('sales');
        Route::view('/stock', 'admin.reports.stock')->name('stock');
        Route::view('/top-products', 'admin.reports.top-products')->name('top-products');

        Route::get('/export', function () {
            // ใส่ logic จริงภายหลัง
            return response()->json(['message' => 'ดาวน์โหลดรายงาน']);
        })->name('export');
    });

    // ────── Settings ──────
    Route::view('settings', 'admin.settings.index')->name('settings.index');
});
