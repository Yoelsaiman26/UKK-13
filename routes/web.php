<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurusanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routes untuk pengaduan
Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
    Route::get('/', [DashboardController::class, 'pengaduanIndex'])->name('index');
});

// Routes untuk sarana
Route::prefix('sarana')->name('sarana.')->group(function () {
    Route::get('/kelas', [DashboardController::class, 'saranaKelas'])->name('kelas');
    Route::get('/laboratorium', [DashboardController::class, 'saranaLaboratorium'])->name('laboratorium');
    Route::get('/perpustakaan', [DashboardController::class, 'saranaPerpustakaan'])->name('perpustakaan');
    Route::get('/olahraga', [DashboardController::class, 'saranaOlahraga'])->name('olahraga');
});

// Routes untuk laporan
Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::get('/', [DashboardController::class, 'laporanIndex'])->name('index');
});

// Routes untuk pengguna
Route::prefix('pengguna')->name('pengguna.')->group(function () {
    Route::get('/', [DashboardController::class, 'penggunaIndex'])->name('index');
});

// Routes untuk pengaturan
Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
    Route::get('/profil', [DashboardController::class, 'pengaturanProfil'])->name('profil');
    Route::get('/sistem', [DashboardController::class, 'pengaturanSistem'])->name('sistem');
});

Route::prefix('kategori')->name('kategori.')->group(function () {
    Route::get('/', [KategoriController::class, 'index'])->name('index');
    Route::get('/create', [KategoriController::class, 'create'])->name('create');
    Route::post('/', [KategoriController::class, 'store'])->name('store');
    Route::get('/{kategori}', [KategoriController::class, 'show'])->name('show');
    Route::get('/{kategori}/edit', [KategoriController::class, 'edit'])->name('edit');
    Route::put('/{kategori}', [KategoriController::class, 'update'])->name('update');
    Route::delete('/{kategori}', [KategoriController::class, 'destroy'])->name('destroy');
});

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('index');
    Route::get('/create', [SiswaController::class, 'create'])->name('create');
    Route::post('/', [SiswaController::class, 'store'])->name('store');
    Route::get('/{siswa}', [SiswaController::class, 'show'])->name('show');
    Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('edit');
    Route::put('/{siswa}', [SiswaController::class, 'update'])->name('update');
    Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('destroy');
});

Route::prefix('jurusan')->name('jurusan.')->group(function () {
    Route::get('/', [JurusanController::class, 'index'])->name('index');
    Route::post('/', [JurusanController::class, 'store'])->name('store');
    Route::delete('/{jurusan}', [JurusanController::class, 'destroy'])->name('destroy');
});
