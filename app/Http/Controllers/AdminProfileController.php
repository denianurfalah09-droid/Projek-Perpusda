<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Aktivitas;

class AdminProfileController extends Controller
{
    /**
     * Tampilkan halaman profil admin
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            // Ambil admin pertama atau buat objek dummy
            $user = User::first() ?? new User([
                'name' => 'Administrator Perpusda',
                'email' => 'admin@perpusda.purwakarta.go.id',
            ]);
        }

        return view('admin.profil', compact('user'));
    }

    /**
     * Perbarui data profil admin
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            $user = User::first();
        }

        $userId = $user ? $user->id : 1;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
        ], [
            'name.required' => 'Nama administrator wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Alamat email sudah digunakan oleh pengguna lain.',
        ]);

        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
        }

        Aktivitas::create([
            'judul' => 'Admin memperbarui profil akun',
            'deskripsi' => 'Data profil admin berhasil diperbarui: ' . $request->name,
            'tipe' => 'profile',
            'icon' => 'user',
        ]);

        return back()->with('success', 'Profil admin berhasil diperbarui!');
    }

    /**
     * Perbarui password admin
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'current_password.required' => 'Password saat ini harus diisi.',
            'password.required' => 'Password baru harus diisi.',
            'password.min' => 'Password baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();
        if (!$user) {
            $user = User::first();
        }

        if ($user && !Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
        }

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        Aktivitas::create([
            'judul' => 'Admin mengubah password akun',
            'deskripsi' => 'Password akun admin berhasil diubah untuk keamanan sistem',
            'tipe' => 'security',
            'icon' => 'lock',
        ]);

        return back()->with('success', 'Password admin berhasil diubah!');
    }
}
