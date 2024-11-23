<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

//LOGIN
Route::get('/', function () {
    return view('login');
});
Route::get('/test', function () {
    return view('template');
});

//Mahasiswa
Route::get('/dashboard_mhs', function () {
    return view('dashboard_mhs');
});
// ->middleware(['auth', 'verified'])->name('dashboard_mhs')

//Pembimbing Akademik
Route::get('/dashboardpa', function () {
    return view('dashboardpa');
});

Route::get('/irspa', function () {
    return view('irspa');
});

//Bagian Akademik
Route::get('/dashboard_bagianAkademik', function () {
    return view('dashboard_bagianAkademik');
})->middleware(['auth', 'verified'])->name('dashboard_dekan');

//Dekan
Route::get('/dashboard_dekan', function () {
    return view('dashboard_dekan');
});

// ->middleware(['auth', 'verified'])->name('dashboard_bagianAkademik')


//Kaprodi
Route::get('/dashboard_kaprodi', function () {
    return view('dashboard_kaprodi');
});
// ->middleware(['auth', 'verified'])->name('dashboard_kaprodi')


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php