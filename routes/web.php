<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;

// ==================== GUEST ROUTES ====================
// Halaman Login (bisa diakses tanpa login)
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// ==================== ADMIN & GURU ROUTES ====================
// Hanya bisa diakses oleh admin dan guru
Route::middleware(['auth', 'role:admin,guru'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Update Status Aspirasi
    Route::post('aspirasi/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.aspirasi.status');
    
    // Berikan Umpan Balik
    Route::post('aspirasi/{id}/feedback', [AdminController::class, 'giveFeedback'])->name('admin.aspirasi.feedback');
    
    // Hapus Aspirasi
    Route::delete('aspirasi/{id}', [AdminController::class, 'deleteAspirasi'])->name('admin.aspirasi.delete');
    
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// ==================== SISWA ROUTES ====================
// Hanya bisa diakses oleh siswa
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    
    // Dashboard Siswa
    Route::get('dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    
    // Kirim Aspirasi Baru
    Route::post('aspirasi', [SiswaController::class, 'store'])->name('siswa.aspirasi.store');
    
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('siswa.logout');
});

// ==================== REDIRECT DEFAULT ====================
Route::get('/', function () {
    return redirect('login');
});

// ==================== GUEST ROUTES ====================
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Register Routes
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'role:admin,guru'])->prefix('admin')->group(function () {
    
    // Dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Filter Aspirasi
    Route::get('aspirasi/filter', [AdminController::class, 'filterAspirasi'])->name('admin.aspirasi.filter');
    
    // Update Status Aspirasi
    Route::post('aspirasi/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.aspirasi.status');
    
    // Berikan Umpan Balik
    Route::post('aspirasi/{id}/feedback', [AdminController::class, 'giveFeedback'])->name('admin.aspirasi.feedback');
    
    // Hapus Aspirasi
    Route::delete('aspirasi/{id}', [AdminController::class, 'deleteAspirasi'])->name('admin.aspirasi.delete');
    
    // CRUD Kategori
    Route::get('kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::post('kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');
    
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
});
