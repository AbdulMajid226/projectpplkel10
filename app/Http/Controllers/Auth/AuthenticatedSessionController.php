<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
    
        // Coba autentikasi pengguna
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
    
            // Redirect berdasarkan peran pengguna (role)
            switch ($user->role) {
                case 'mhs': // Mahasiswa
                    return redirect()->route('dashboard_mhs');
                case 'pa': // Pembimbing Akademik
                    return redirect()->route('dashboardpa');
                case 'dk': // Dekan
                    return redirect()->route('dashboard_dekan');
                case 'ba': // Bagian Akademik
                    return redirect()->route('dashboard_bagianAkademik');
                case 'kpr': // Kaprodi
                    return redirect()->route('dashboard_kaprodi');
                default:
                    Auth::logout();
                    return back()->withErrors([
                        'role' => 'Role Anda tidak dikenali. Silakan hubungi administrator.',
                    ]);
            }
        }
    
        // Jika kredensial salah, kembalikan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('email')); // Mengingat email yang dimasukkan
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout(); // Logout pengguna

        // Invalidate session dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}