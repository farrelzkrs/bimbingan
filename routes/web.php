<?php

use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- GRUP UNTUK SEMUA USER YANG LOGIN (Admin, Dosen, Mahasiswa) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // My projects route
    Route::get('/my-projects', [SkripsiController::class, 'myProjects'])->name('skripsi.my-projects');

    // Profile routes
    Route::get('/mahasiswa/profile', [MahasiswaController::class, 'profile'])->name('mahasiswa.profile');
    Route::get('/dosen/profile', [DosenController::class, 'profile'])->name('dosen.profile');

    Route::get('/skripsi/create', [SkripsiController::class, 'create'])->name('skripsi.create');
    Route::post('/skripsi', [SkripsiController::class, 'store'])->name('skripsi.store');
    Route::get('/skripsi/{skripsi}/edit', [SkripsiController::class, 'edit'])->name('skripsi.edit');
    Route::put('/skripsi/{skripsi}', [SkripsiController::class, 'update'])->name('skripsi.update');
    Route::delete('/skripsi/{skripsi}', [SkripsiController::class, 'destroy'])->name('skripsi.destroy');
    Route::get('/skripsi', [SkripsiController::class, 'index'])->name('skripsi.index');
    Route::get('/skripsi/{skripsi}', [SkripsiController::class, 'show'])->name('skripsi.show');
});

Route::get('/hasil-bimbingan', [BimbinganController::class, 'indexMahasiswa'])
    ->middleware('role:user')
    ->name('bimbingan.mahasiswa');

// Untuk Dosen (Manajemen Bimbingan)
Route::middleware('role:admin')->group(function () {
    Route::get('/bimbingan-dosen', [BimbinganController::class, 'indexDosen'])->name('bimbingan.dosen.index');
    Route::get('/bimbingan-dosen/{skripsi}', [BimbinganController::class, 'showDosen'])->name('bimbingan.dosen.show');
    Route::post('/bimbingan-dosen/{skripsi}', [BimbinganController::class, 'store'])->name('bimbingan.dosen.store');
});

// --- GRUP KHUSUS ADMIN ---
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('dosen', DosenController::class);
    Route::get('/bimbingan-dosen', [BimbinganController::class, 'indexDosen'])->name('bimbingan.dosen.index');
});
// Di dalam routes/web.php
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/hasil-bimbingan', [BimbinganController::class, 'indexMahasiswa'])->name('bimbingan.mahasiswa');
    Route::post('/hasil-bimbingan', [BimbinganController::class, 'storeMahasiswa'])->name('bimbingan.mahasiswa.store');
});

require __DIR__.'/auth.php';