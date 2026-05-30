<?php

use App\Http\Controllers\StudentDetailController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\StudentTestController;
use App\Http\Controllers\PaymentController;
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

    // Rute Ujian Seleksi & Hasil Seleksi
    Route::get('/test-seleksi', [StudentTestController::class, 'showTest'])->name('student.test.show');
    Route::post('/test-seleksi', [StudentTestController::class, 'submitTest'])->name('student.test.submit');
    Route::get('/hasil-seleksi', [StudentTestController::class, 'showResults'])->name('student.test.results');

    // Rute Pembayaran Formulir
    Route::get('/pembayaran-formulir', [PaymentController::class, 'showFormulir'])->name('student.pembayaran.formulir');
    Route::post('/pembayaran-formulir/simulate', [PaymentController::class, 'simulateFormulir'])->name('student.pembayaran.formulir.simulate');

    // Rute Pembayaran Daftar Ulang
    Route::get('/pembayaran-daftar-ulang', [PaymentController::class, 'showDaftarUlang'])->name('student.pembayaran.daftar_ulang');
    Route::post('/pembayaran-daftar-ulang/simulate', [PaymentController::class, 'simulateDaftarUlang'])->name('student.pembayaran.daftar_ulang.simulate');
});



require __DIR__.'/auth.php';
