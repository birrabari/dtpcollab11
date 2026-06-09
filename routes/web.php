<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashPaymentController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/jadwal', [\App\Http\Controllers\ScheduleController::class, 'index']);

Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');

    Route::get('/bayar-kas',  [CashPaymentController::class, 'index'])->name('bayar-kas.index');
    Route::post('/bayar-kas', [CashPaymentController::class, 'store'])->name('bayar-kas.store');

    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');

    Route::middleware(['is_admin'])->group(function () {
        Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
        Route::post('/admin/payments/{payment}/approve', [\App\Http\Controllers\AdminController::class, 'approve'])->name('admin.approve');
        Route::post('/admin/payments/{payment}/reject', [\App\Http\Controllers\AdminController::class, 'reject'])->name('admin.reject');
        Route::post('/admin/expenses', [\App\Http\Controllers\AdminController::class, 'storeExpense'])->name('admin.expenses.store');
        Route::get('/admin/schedules', [\App\Http\Controllers\AdminController::class, 'schedules'])->name('admin.schedules');
        Route::post('/admin/schedules', [\App\Http\Controllers\AdminController::class, 'storeSchedule'])->name('admin.schedules.store');
        Route::put('/admin/schedules/{schedule}', [\App\Http\Controllers\AdminController::class, 'updateSchedule'])->name('admin.schedules.update');
        Route::delete('/admin/schedules/{schedule}', [\App\Http\Controllers\AdminController::class, 'destroySchedule'])->name('admin.schedules.destroy');
        Route::post('/admin/schedules/{schedule}/toggle', [\App\Http\Controllers\AdminController::class, 'toggleSchedule'])->name('admin.schedules.toggle');
        Route::get('/admin/schedules/{schedule}/attendance', [\App\Http\Controllers\AdminAttendanceController::class, 'show'])->name('admin.attendance.show');
        Route::post('/admin/schedules/{schedule}/attendance', [\App\Http\Controllers\AdminAttendanceController::class, 'store'])->name('admin.attendance.store');

        Route::resource('/admin/events', \App\Http\Controllers\AdminEventController::class, ['as' => 'admin'])->except(['create', 'show', 'edit']);
        Route::resource('/admin/users', \App\Http\Controllers\AdminUserController::class, ['as' => 'admin'])->except(['create', 'show', 'store']);
        Route::resource('/admin/achievements', \App\Http\Controllers\AdminAchievementController::class, ['as' => 'admin'])->except(['create', 'show', 'edit']);
    });
});
