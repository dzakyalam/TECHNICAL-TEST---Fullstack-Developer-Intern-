<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::get('/vehicles', [VehicleController::class, 'index']);
        Route::post('/vehicles', [VehicleController::class, 'store']);

        Route::get('/drivers', [DriverController::class, 'index']);
        Route::post('/drivers', [DriverController::class, 'store']);

        Route::get('/bookings', [BookingController::class, 'index']);
        Route::get('/bookings/create', [BookingController::class, 'create']);
        Route::post('/bookings', [BookingController::class, 'store']);

        Route::get('/reports/export', [ReportController::class, 'export']);
    });

    Route::middleware('role:approver')->group(function () {
        Route::get('/approvals', [ApprovalController::class, 'index']);
        Route::post('/approvals/{id}/approve', [ApprovalController::class, 'approve']);
        Route::post('/approvals/{id}/reject', [ApprovalController::class, 'reject']);
    });
});

require __DIR__.'/auth.php';