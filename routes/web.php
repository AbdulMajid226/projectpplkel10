<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\IRSController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use App\Models\IRS;

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
Route::middleware(['auth', 'verified'])->group(function () {
    //dashboard mahasiswa
    Route::get('/dashboard_mhs', function () {
        $mahasiswa = Mahasiswa::with('pembimbingAkademik')
                             ->where('user_id', Auth::id())
                             ->first();

        return view('mahasiswa.dashboard', compact('mahasiswa'));
    })->name('dashboard_mhs');

    Route::get('/irs_mhs', function () {
        $nim = Auth::user()->mahasiswa->nim;
        $jumlah_semester = IRS::countIRSByNIM($nim);

        $irs_data = IRS::getIRSByNIM($nim);

        return view('mahasiswa.irs', compact('jumlah_semester', 'irs_data'));
    })->name('irs_mhs');

    //Registrasi mahasiswa
    Route::get('/registrasi_mhs', function () {
        return view('mahasiswa.registrasi');
    })->name('registrasi_mhs');

    Route::get('/khs_mhs', function () {
        return view('mahasiswa.khs');
    })->name('khs_mhs');

    Route::post('/mahasiswa/aktif', [App\Http\Controllers\MahasiswaController::class, 'setStatusAktif'])
        ->name('mahasiswa.aktif');

    Route::post('/mahasiswa/cuti', [App\Http\Controllers\MahasiswaController::class, 'setStatusCuti'])
        ->name('mahasiswa.ajukan-cuti');

    //Buat IRS mahasiswa
    Route::get('/buat_irs_mhs', [IRSController::class, 'create'])->name('mahasiswa.buat_irs');

    //KHS mahasiswa
    Route::get('/khs_mhs', function () {
        return view('mahasiswa.khs');
    })->name('khs_mhs');

    // Tambahkan route baru dalam group middleware auth
    Route::post('/irs/approve/{id}', [IRSController::class, 'approve'])->name('irs.approve');

    Route::post('/irs/cancel/{id}', [IRSController::class, 'cancelApproval'])->name('irs.cancel');

    Route::get('/irs/detail/{id}', [IRSController::class, 'getDetail'])->name('irs.detail');

});

//Pembimbing Akademik
Route::get('/dashboardpa', function () {
    $irsController = new IRSController();

    $jumlahstatus = [
        'belumMengisi' => $irsController->countByStatus('Belum Mengisi'),
        'menungguPersetujuan' => $irsController->countByStatus('Menunggu Persetujuan'),
        'disetujui' => $irsController->countByStatus('Sudah Disetujui')
    ];

    $irsData = [
        'belumMengisi' => $irsController->getIRSByStatus('Belum Mengisi'),
        'menungguPersetujuan' => $irsController->getIRSByStatus('Menunggu Persetujuan'),
        'disetujui' => $irsController->getIRSByStatus('Sudah Disetujui')
    ];

    return view('dosen_pa.dashboard', compact('jumlahstatus', 'irsData'));
})->middleware(['auth', 'verified'])->name('dashboardpa');

Route::get('/irspa', function () {
    return view('dosen_pa.irs');
})->middleware(['auth', 'verified'])->name('irspa');

//Bagian Akademik
Route::get('/dashboard_bagianAkademik', [RuangController::class, 'dashboard'])->name('dashboard_bagianAkademik');


Route::get('/ajukanruangkuliah', [RuangController::class, 'index'])->middleware(['auth', 'verified'])->name('ajukanruangkuliah');

Route::post('/ajukanruang', [RuangController::class, 'store'])->name('ajukanruang.store');
Route::get('/ajukanruang', [RuangController::class, 'index'])->name('ajukanruang.index');

Route::delete('/ruang/{ruang}', [RuangController::class, 'destroy'])->name('ruang.destroy');

Route::get('/ruang/{ruang}/edit', [RuangController::class, 'edit'])->name('ruang.edit');
Route::put('/ruang/{ruang}', [RuangController::class, 'update'])->name('ruang.update');

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
    Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
