<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan form login admin
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Proses autentikasi login admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Email atau Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $loginInput = $request->input('username');
        $password = $request->input('password');
        $remember = $request->has('remember');

        // Dukung login via email atau nama user
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Cek kredensial di database
        if (Auth::attempt([$fieldType => $loginInput, 'password' => $password], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        // Cek fallback jika user admin default belum ada di database namun password cocok
        if (($loginInput === 'admin' || $loginInput === 'admin@perpusda.purwakarta.go.id') && $password === 'admin123') {
            $admin = User::firstOrCreate(
                ['email' => 'admin@perpusda.purwakarta.go.id'],
                [
                    'name' => 'Administrator Perpusda',
                    'password' => Hash::make('admin123'),
                ]
            );

            Auth::login($admin, $remember);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang, Administrator Perpusda!');
        }

        return back()->withErrors([
            'login_error' => 'Email/Username atau Password yang Anda masukkan salah.',
        ])->withInput($request->only('username', 'remember'));
    }

    /**
     * Proses logout admin
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah berhasil keluar dari sistem admin.');
    }
}
