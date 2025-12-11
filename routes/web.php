<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // My projects route
    Route::get('/my-projects', [SkripsiController::class, 'myProjects'])->name('skripsi.my-projects');

    // Profile routes untuk mahasiswa, dosen
    Route::get('/mahasiswa/profile', [MahasiswaController::class, 'profile'])->name('mahasiswa.profile');
    Route::get('/dosen/profile', [DosenController::class, 'profile'])->name('dosen.profile');
});

// Admin routes for CRUD
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('skripsi', SkripsiController::class);
});

require __DIR__.'/auth.php';

