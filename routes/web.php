<?php

use App\Http\Controllers\StudentDetailController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/biodata/edit', [StudentDetailController::class, 'edit'])->name('student.profile.edit');
    Route::post('/biodata/update', [StudentDetailController::class, 'update'])->name('student.profile.update');
    Route::post('/biodata/store', [StudentDetailController::class, 'store'])->name('biodata.store');
    Route::patch('/dashboard/jenjang', [DashboardController::class, 'updateJenjang'])->name('jenjang.update');

    // Rute Pemberkasan (Berkas - Berkas)
    Route::get('/pemberkasan', [StudentDocumentController::class, 'edit'])->name('student.pemberkasan.edit');
    Route::post('/pemberkasan', [StudentDocumentController::class, 'store'])->name('student.pemberkasan.store');
    Route::delete('/pemberkasan/{type}', [StudentDocumentController::class, 'destroy'])->name('student.pemberkasan.destroy');
});



require __DIR__.'/auth.php';
