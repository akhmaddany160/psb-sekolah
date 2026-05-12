<?php

use App\Http\Controllers\StudentDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/edit', [StudentDetailController::class, 'edit'])->name('student.profile.edit');
    Route::post('/profile/update', [StudentDetailController::class, 'update'])->name('student.profile.update');
    Route::post('/biodata/store', [StudentDetailController::class, 'store'])->name('biodata.store');
    Route::patch('/dashboard/jenjang', [DashboardController::class, 'updateJenjang'])->name('jenjang.update');
});



require __DIR__.'/auth.php';
