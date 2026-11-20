<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

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
        $remember = $request->boolean('remember');

        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'name';

        if (Auth::attempt([
            $fieldType => $loginInput,
            'password' => $password,
        ], $remember)) {

            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'login_error' => 'Email/Username atau Password salah.',
        ])->withInput($request->only('username', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda berhasil keluar dari sistem admin.');
    }
}
