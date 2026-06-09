<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashPaymentController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/jadwal', function () {
    return view('schedule');
});

Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    });

    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');

    Route::get('/bayar-kas',  [CashPaymentController::class, 'index'])->name('bayar-kas.index');
    Route::post('/bayar-kas', [CashPaymentController::class, 'store'])->name('bayar-kas.store');

    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
});
