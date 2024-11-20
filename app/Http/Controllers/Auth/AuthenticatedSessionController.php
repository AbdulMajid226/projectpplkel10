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
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            //check role to redirect
            if($user->role === 'mhs'){
                return redirect()->route('dashboard_mhs');
            }elseif($user->role ==='pa'){
                return redirect()->route('dashboardpa');
            }elseif ($user->role === 'dk') {
                return redirect()->route('dashboard_dekan');
            }elseif ($user->role === 'ba') {
                return redirect()->route('dashboard_bagianAkademik');
            }elseif ($user->role === 'kpr') {
                return redirect()->route('dashboard_kaprodi');
            }
           
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
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