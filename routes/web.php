<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

//LOGIN & AUTH
Route::get('/', function () {
    return view('login');
})->name('login');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
});

//Mahasiswa
Route::get('/dashboard_mhs', function () {
    $mahasiswa = Mahasiswa::with('pembimbingAkademik')
                         ->where('user_id', Auth::id())
                         ->first();

    return view('mahasiswa.dashboard', compact('mahasiswa'));
})->middleware(['auth', 'verified'])->name('dashboard_mhs');

Route::get('/irs_mhs', function () {
    return view('mahasiswa.irs');
})->middleware(['auth', 'verified'])->name('irs_mhs');

Route::get('/registrasi_mhs', function () {
    return view('mahasiswa.registrasi');
})->middleware(['auth', 'verified'])->name('registrasi_mhs');

Route::get('/khs_mhs', function () {
    return view('mahasiswa.khs');
})->middleware(['auth', 'verified'])->name('khs_mhs');

Route::get('/buat_irs_mhs', function () {
    return view('mahasiswa.buat_irs');
})->middleware(['auth', 'verified'])->name('buat_irs_mhs');

//Pembimbing Akademik
Route::get('/dashboardpa', function () {
    return view('dosen_pa.dashboard');
})->middleware(['auth', 'verified'])->name('dashboardpa');

Route::get('/irspa', function () {
    return view('dosen_pa.irs');
})->middleware(['auth', 'verified'])->name('irspa');

//Bagian Akademik
Route::get('/dashboard_bagianAkademik', function () {
    return view('bagian_akademik.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard_bagianAkademik');

Route::get('/ajukanruangkuliah', function () {
    return view('bagian_akademik.ajukan_ruang');
})->middleware(['auth', 'verified'])->name('ajukanruangkuliah');

// API routes untuk ruang
Route::get('/api/rooms', [RuangController::class, 'getRoomsByStatus'])->middleware(['auth', 'verified']);
Route::put('/api/rooms/{kodeRuang}', [RuangController::class, 'updateRoom'])->middleware(['auth', 'verified']);
Route::delete('/api/rooms/{kodeRuang}', [RuangController::class, 'deleteRoom'])->middleware(['auth', 'verified']);
Route::get('/api/room-counts', [RuangController::class, 'getRoomCounts'])->middleware(['auth', 'verified']);

//Dekan
Route::get('/dashboard_dekan', function () {
    return view('dekan.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard_dekan');

Route::get('/pengesahanruangkuliah', function () {
    return view('dekan.pengesahan_ruang');
})->middleware(['auth', 'verified'])->name('pengesahanruangkuliah');

Route::get('/pengesahanjadwalkuliah', function () {
    return view('dekan.pengesahan_jadwal');
})->middleware(['auth', 'verified'])->name('pengesahanjadwalkuliah');

//Kaprodi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard_kaprodi', function () {
        return view('kaprodi.dashboard');
    })->name('dashboard_kaprodi');

    Route::get('/buatjadwalkuliah', [JadwalController::class, 'index'])->name('buatjadwalkuliah');
    Route::post('/buatjadwalkuliah', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';