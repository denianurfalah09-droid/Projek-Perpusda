<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * Tampilkan daftar fasilitas perpustakaan
     */
    public function index()
    {
        $fasilitas = Fasilitas::orderBy('id_fasilitas', 'desc')->get();

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Form tambah fasilitas baru
     */
    public function create()
    {
        return view('admin.fasilitas.create');
    }

    /**
     * Simpan fasilitas baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi'      => 'required|string',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'nama_fasilitas.required' => 'Nama fasilitas wajib diisi.',
            'deskripsi.required'      => 'Deskripsi fasilitas wajib diisi.',
            'gambar.image'            => 'Berkas harus berupa gambar (JPG, JPEG, PNG, WebP).',
            'gambar.max'              => 'Ukuran gambar fasilitas maksimal 3MB.',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('fasilitas', 'public');
        }

        $fasilitas = Fasilitas::create([
            'nama_fasilitas' => $request->nama_fasilitas,
            'deskripsi'      => $request->deskripsi,
            'gambar'         => $gambarPath,
        ]);

        try {
            Aktivitas::create([
                'judul'     => 'Penambahan Fasilitas',
                'deskripsi' => 'Fasilitas baru ditambahkan: ' . $fasilitas->nama_fasilitas,
                'tipe'      => 'fasilitas',
                'icon'      => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.fasilitas')
            ->with('success', 'Fasilitas "' . $fasilitas->nama_fasilitas . '" berhasil ditambahkan.');
    }

    /**
     * Form edit fasilitas
     */
    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    /**
     * Perbarui data fasilitas
     */
    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi'      => 'required|string',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'nama_fasilitas.required' => 'Nama fasilitas wajib diisi.',
            'deskripsi.required'      => 'Deskripsi fasilitas wajib diisi.',
            'gambar.image'            => 'Berkas harus berupa gambar (JPG, JPEG, PNG, WebP).',
            'gambar.max'              => 'Ukuran gambar fasilitas maksimal 3MB.',
        ]);

        $data = [
            'nama_fasilitas' => $request->nama_fasilitas,
            'deskripsi'      => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($fasilitas->gambar && Storage::disk('public')->exists($fasilitas->gambar)) {
                Storage::disk('public')->delete($fasilitas->gambar);
            } elseif ($fasilitas->gambar && file_exists(public_path('images/' . $fasilitas->gambar))) {
                @unlink(public_path('images/' . $fasilitas->gambar));
            }
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        $fasilitas->update($data);

        try {
            Aktivitas::create([
                'judul'     => 'Pembaruan Fasilitas',
                'deskripsi' => 'Fasilitas diperbarui: ' . $fasilitas->nama_fasilitas,
                'tipe'      => 'fasilitas',
                'icon'      => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.fasilitas')
            ->with('success', 'Fasilitas "' . $fasilitas->nama_fasilitas . '" berhasil diperbarui.');
    }

    /**
     * Hapus fasilitas dari database
     */
    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        if ($fasilitas->gambar && Storage::disk('public')->exists($fasilitas->gambar)) {
            Storage::disk('public')->delete($fasilitas->gambar);
        } elseif ($fasilitas->gambar && file_exists(public_path('images/' . $fasilitas->gambar))) {
            @unlink(public_path('images/' . $fasilitas->gambar));
        }

        $nama = $fasilitas->nama_fasilitas;
        $fasilitas->delete();

        try {
            Aktivitas::create([
                'judul'     => 'Penghapusan Fasilitas',
                'deskripsi' => 'Fasilitas dihapus: ' . $nama,
                'tipe'      => 'fasilitas',
                'icon'      => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.fasilitas')
            ->with('success', 'Fasilitas "' . $nama . '" berhasil dihapus.');
    }
}

