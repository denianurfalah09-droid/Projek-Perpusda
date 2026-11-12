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
    /**
     * Tampilkan daftar akun pengguna / admin
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Form tambah user baru
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Simpan user baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ], [
            'name.required'     => 'Nama atau username wajib diisi.',
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Alamat email sudah digunakan oleh akun lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal terdiri dari 6 karakter.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        try {
            Aktivitas::create([
                'judul'     => 'Penambahan Akun Pengguna',
                'deskripsi' => 'Pengguna baru ditambahkan: ' . $user->name . ' (' . $user->email . ')',
                'tipe'      => 'user',
                'icon'      => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.user')
            ->with('success', 'User "' . $user->name . '" berhasil ditambahkan.');
    }

    /**
     * Form edit user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Perbarui data user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ], [
            'name.required' => 'Nama atau username wajib diisi.',
            'email.required'=> 'Alamat email wajib diisi.',
            'email.email'   => 'Format email tidak valid.',
            'email.unique'  => 'Alamat email sudah digunakan oleh akun lain.',
            'password.min'  => 'Password baru minimal 6 karakter.',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        try {
            Aktivitas::create([
                'judul'     => 'Pembaruan Akun Pengguna',
                'deskripsi' => 'Data akun pengguna diperbarui: ' . $user->name,
                'tipe'      => 'user',
                'icon'      => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.user')
            ->with('success', 'Data user "' . $user->name . '" berhasil diperbarui.');
    }

    /**
     * Hapus user dari database
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Jangan hapus user yang sedang login
        if (Auth::id() == $user->id) {
            return back()->with('error', 'Akun admin yang sedang aktif login tidak dapat dihapus.');
        }

        // Jangan hapus jika hanya tersisa 1 user
        if (User::count() <= 1) {
            return back()->with('error', 'Tidak dapat menghapus satu-satunya akun administrator sistem.');
        }

        $nama = $user->name;
        $user->delete();

        try {
            Aktivitas::create([
                'judul'     => 'Penghapusan Akun Pengguna',
                'deskripsi' => 'Pengguna dihapus: ' . $nama,
                'tipe'      => 'user',
                'icon'      => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.user')
            ->with('success', 'User "' . $nama . '" berhasil dihapus.');
    }
}

