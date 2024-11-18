<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Tentukan role berdasarkan domain email
        
        if (str_contains($request->email, '@students')) {
            $role = 'mhs';
        }
        else if (str_contains($request->email, '@lecturer')) {
            $role = 'pa';
        }

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $role,
        ]));

        // Redirect berdasarkan role
        if ($role === 'mhs') {
            return redirect()->route('dashboard_mhs');
        } elseif ($role === 'pa') {
            return redirect()->route('dashboardpa');
        }

    }
}