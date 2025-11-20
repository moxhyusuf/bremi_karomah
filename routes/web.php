<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductionController;

Route::get('auth/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('auth/login', [AuthController::class, 'login'])->name('login');
Route::get('auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // * DASHBOARD
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    // * USER
    Route::resource('user', UserController::class)
        ->middleware('role.access:admin');

    // * CUSTOMER
    Route::resource('customer', CustomerController::class)
        ->middleware('role.access:admin,operator,manager');

    // * ORDER
    Route::resource('order', OrderController::class)
        ->middleware('role.access:admin,operator,manager');

    // * MATERIAL
    Route::resource('material', MaterialController::class)
        ->middleware('role.access:admin,operator,manager');

    // * Production
    Route::resource('production', ProductionController::class)
        ->middleware('role.access:admin,operator,manager');

    // * DELIVERY
    Route::resource('delivery', DeliveryController::class)
        ->middleware('role.access:admin,operator,manager');

    // * Report
    Route::middleware(['role.access:admin,operator,manager'])->group(function () {
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');
        Route::get('/report/generate', [ReportController::class, 'generate'])->name('report.generate');
    });
});
