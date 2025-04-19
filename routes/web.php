<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;

// routes auth
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // routes dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // routes siswa
    Route::resource('siswa', SiswaController::class);
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('siswa/{id}', [SiswaController::class, 'update']);

    // routes kelas
    Route::resource('kelas', KelasController::class);
    Route::get('/kelas/edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/update/{id}', [KelasController::class, 'update']);

    // routes guru
    Route::resource('guru', GuruController::class);
    Route::get('guru/edit/{id}', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('guru/update/{id}', [GuruController::class, 'update'])->name('guru.update');

    // routes laporan
    Route::get('/laporan/siswa-kelas-guru', [LaporanController::class, 'index'])->name('laporan.siswa-kelas-guru');
});