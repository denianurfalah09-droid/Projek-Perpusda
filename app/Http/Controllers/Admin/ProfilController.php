<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Tampilkan form profil perpustakaan
     */
    public function index()
{
    $profil = Profil::firstOrCreate(
        ['id' => 1],
        [
            'judul' => 'Dinas Kearsipan dan Perpustakaan Daerah Kabupaten Purwakarta',
            'isi'   => 'Perpustakaan Daerah Kabupaten Purwakarta melayani kebutuhan literasi, riset, dan informasi masyarakat secara menyeluruh dan inklusif.',
        ]
    );

    $user = auth()->user();

    return view('admin.profil', compact('profil', 'user'));
}

    /**
     * Perbarui data profil perpustakaan
     */
    public function update(Request $request)
    {
        $profil = Profil::firstOrCreate(['id' => 1]);

        $data = $request->validate([
            'judul'  => 'required|string|max:255',
            'isi'    => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'judul.required' => 'Judul profil perpustakaan wajib diisi.',
            'isi.required'   => 'Isi profil perpustakaan wajib diisi.',
            'gambar.image'   => 'Berkas harus berupa gambar (JPG, JPEG, PNG, WebP).',
            'gambar.max'     => 'Ukuran gambar maksimal 3MB.',
        ]);

        if ($request->hasFile('gambar')) {
            if ($profil->gambar && Storage::disk('public')->exists($profil->gambar)) {
                Storage::disk('public')->delete($profil->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('profil', 'public');
        }

        $profil->update($data);

        try {
            Aktivitas::create([
                'judul'     => 'Pembaruan Profil Perpustakaan',
                'deskripsi' => 'Data profil perpustakaan diperbarui: ' . $profil->judul,
                'tipe'      => 'profil',
                'icon'      => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()->route('admin.profil')->with('success', 'Data profil perpustakaan berhasil diperbarui.');
    }
}

