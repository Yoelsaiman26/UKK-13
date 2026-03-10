<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\AspirasiController;

Route::get('/', function () {
    // return view('/login');
    return redirect()->route('login');
});
Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'login'])->name('login.post');
Route::post('/login/siswa',[LoginController::class,'loginSiswa'])->name('login.siswa.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth:siswas,web']);

// Routes untuk pengaduan
Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
    Route::get('/', [DashboardController::class, 'pengaduanIndex'])->name('index');
})->middleware(['auth:siswas,web']);

// Routes untuk sarana
Route::prefix('sarana')->name('sarana.')->group(function () {
    Route::get('/kelas', [DashboardController::class, 'saranaKelas'])->name('kelas');
    Route::get('/laboratorium', [DashboardController::class, 'saranaLaboratorium'])->name('laboratorium');
    Route::get('/perpustakaan', [DashboardController::class, 'saranaPerpustakaan'])->name('perpustakaan');
    Route::get('/olahraga', [DashboardController::class, 'saranaOlahraga'])->name('olahraga');
})->middleware('auth:siswas,web');

// Routes untuk laporan
Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::get('/', [DashboardController::class, 'laporanIndex'])->name('index');
})->middleware('auth:siswas,web');

// Routes untuk pengguna
Route::prefix('pengguna')->name('pengguna.')->group(function () {
    Route::get('/', [DashboardController::class, 'penggunaIndex'])->name('index');
})->middleware('auth:siswas,web');

// Routes untuk pengaturan
Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
    Route::get('/profil', [DashboardController::class, 'pengaturanProfil'])->name('profil');
    Route::get('/sistem', [DashboardController::class, 'pengaturanSistem'])->name('sistem');
})->middleware('auth:siswas');

Route::prefix('kategori')->name('kategori.')->group(function () {
    Route::get('/', [KategoriController::class, 'index'])->name('index')->middleware('auth:web');
    Route::get('/create', [KategoriController::class, 'create'])->name('create')->middleware('auth:web');
    Route::post('/', [KategoriController::class, 'store'])->name('store')->middleware('auth:web');
    Route::get('/{kategori}', [KategoriController::class, 'show'])->name('show')->middleware('auth:web');
    Route::get('/{kategori}/edit', [KategoriController::class, 'edit'])->name('edit')->middleware('auth:web');
    Route::put('/{kategori}', [KategoriController::class, 'update'])->name('update')->middleware('auth:web');
    Route::delete('/{kategori}', [KategoriController::class, 'destroy'])->name('destroy')->middleware('auth:web');
})->middleware('auth:web');

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('index')->middleware('auth:web');
    Route::get('/create', [SiswaController::class, 'create'])->name('create')->middleware('auth:web');
    Route::post('/', [SiswaController::class, 'store'])->name('store')->middleware('auth:web');
    Route::get('/{siswa}', [SiswaController::class, 'show'])->name('show')->middleware('auth:web');
    Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('edit')->middleware('auth:web');
    Route::put('/{siswa}', [SiswaController::class, 'update'])->name('update')->middleware('auth:web');
    Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('destroy')->middleware('auth:web');
})->middleware('auth:web');

Route::prefix('jurusan')->name('jurusan.')->group(function () {
    Route::get('/', [JurusanController::class, 'index'])->name('index')->middleware('auth:web');
    Route::post('/', [JurusanController::class, 'store'])->name('store')->middleware('auth:web');
    Route::delete('/{jurusan}', [JurusanController::class, 'destroy'])->name('destroy')->middleware('auth:web');
})->middleware('auth:web');

Route::prefix('pengguna')->name('pengguna.')->group(function () {
    Route::get('/',[PenggunaController::class, 'index'])->name('index')->middleware('auth:web');
    Route::get('/create', [PenggunaController::class, 'create'])->name('create')->middleware('auth:web');
})->middleware('auth:web');

Route::prefix('aspirasi')->name('aspirasi.')->group(function (){
    Route::get('/', [AspirasiController::class, 'index'])->name('index');
    Route::get('/create', [AspirasiController::class, 'create'])->name('create');
    Route::post('/', [AspirasiController::class, 'store'])->name('store');
    Route::get('/{aspirasi}', [AspirasiController::class, 'show'])->name('show');
    Route::get('/{aspirasi}/edit', [AspirasiController::class, 'edit'])->name('edit');
    Route::put('/{aspirasi}', [AspirasiController::class, 'update'])->name('update');
    Route::delete('/{aspirasi}', [AspirasiController::class, 'destroy'])->name('destroy');
    Route::post('/umpan-balik/{id}', [AspirasiController::class, 'umpanBalik'])->name('umpan-balik');
});