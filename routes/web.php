<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/invoices/json', [InvoiceController::class, 'getInvoicesByCurrency']);


Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:Admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/about', [AdminController::class, 'about'])->name('admin.about');
        Route::get('/contact-us', [AdminController::class, 'contact'])->name('admin.contact');
    });

    Route::middleware(['role:Camp'])->prefix('camp')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard_camp'])->name('camp.dashboard');
        Route::get('/about', [AdminController::class, 'about_camp'])->name('camp.about');
        Route::get('/contact-us', [AdminController::class, 'contact_camp'])->name('camp.contact');
    });

    Route::middleware(['role:Sales Supervisor'])->prefix('sales-supervisor')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard_sales'])->name('sales.dashboard');
        Route::get('/about', [AdminController::class, 'about_sales'])->name('sales.about');
        Route::get('/contact-us', [AdminController::class, 'contact_sales'])->name('sales.contact');
    });

    Route::middleware(['role:Accounts'])->prefix('accounts')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard_accounts'])->name('accounts.dashboard');
        Route::get('/about', [AdminController::class, 'about_accounts'])->name('accounts.about');
        Route::get('/contact-us', [AdminController::class, 'contact_accounts'])->name('accounts.contact');
    });

    Route::middleware(['role:Staff'])->prefix('staff')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard_staff'])->name('staff.dashboard');
        Route::get('/about', [AdminController::class, 'about_staff'])->name('staff.about');
        Route::get('/contact-us', [AdminController::class, 'contact_staff'])->name('staff.contact');
    });

    Route::middleware(['role:Kitchen'])->prefix('kitchen')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard_kitchen'])->name('kitchen.dashboard');
        Route::get('/about', [AdminController::class, 'about_kitchen'])->name('kitchen.about');
        Route::get('/contact-us', [AdminController::class, 'contact_kitchen'])->name('kitchen.contact');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
