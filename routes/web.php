<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('login');
});
Route::get('/dashboard_mhs', function () {
    return view('dashboard_mhs');
})->middleware(['auth', 'verified'])->name('dashboard_mhs');

Route::get('/dashboardpa', function () {
    return view('dashboardpa');
})->middleware(['auth', 'verified'])->name('dashboardpa');

Route::get('/irspa', function () {
    return view('irspa');
})->middleware(['auth', 'verified'])->name('irspa');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
