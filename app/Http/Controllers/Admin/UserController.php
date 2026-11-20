<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ], [
            'name.required' => 'Username wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        try {
            Aktivitas::create([
                'judul' => 'Penambahan Akun Pengguna',
                'deskripsi' => 'Pengguna baru ditambahkan: ' . $user->name,
                'tipe' => 'user',
                'icon' => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.user')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ], [
            'name.required' => 'Username wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        try {
            Aktivitas::create([
                'judul' => 'Pembaruan Akun Pengguna',
                'deskripsi' => 'Data akun diperbarui: ' . $user->name,
                'tipe' => 'user',
                'icon' => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.user')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() == $user->id) {
            return back()->with(
                'error',
                'Akun yang sedang digunakan tidak dapat dihapus.'
            );
        }

        if (User::count() <= 1) {
            return back()->with(
                'error',
                'Tidak dapat menghapus satu-satunya akun.'
            );
        }

        $nama = $user->name;
        $user->delete();

        try {
            Aktivitas::create([
                'judul' => 'Penghapusan Akun Pengguna',
                'deskripsi' => 'Pengguna dihapus: ' . $nama,
                'tipe' => 'user',
                'icon' => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.user')
            ->with('success', 'User berhasil dihapus.');
    }
}
