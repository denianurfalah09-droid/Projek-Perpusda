<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Tampilkan daftar berita
     */
    public function index()
    {
        $berita = Berita::orderBy('tanggal', 'desc')->get();

        return view('admin.berita.index', compact('berita'));
    }

    /**
     * Form tambah berita baru
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Simpan berita baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'link'    => 'required|url|max:500',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'judul.required'   => 'Judul berita wajib diisi.',
            'link.required'    => 'Link berita wajib diisi.',
            'link.url'         => 'Format tautan link berita tidak valid.',
            'tanggal.required' => 'Tanggal publikasi berita wajib diisi.',
            'gambar.image'     => 'Berkas harus berupa gambar (JPG, JPEG, PNG, WebP).',
            'gambar.max'       => 'Ukuran gambar berita maksimal 3MB.',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        $berita = Berita::create([
            'judul'   => $request->judul,
            'link'    => $request->link,
            'tanggal' => $request->tanggal,
            'gambar'  => $gambarPath,
        ]);

        try {
            Aktivitas::create([
                'judul'     => 'Penambahan Berita Baru',
                'deskripsi' => 'Berita baru ditambahkan: ' . $berita->judul,
                'tipe'      => 'berita',
                'icon'      => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Form edit berita
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);

        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Perbarui data berita di database
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'   => 'required|string|max:255',
            'link'    => 'required|url|max:500',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'judul.required'   => 'Judul berita wajib diisi.',
            'link.required'    => 'Link berita wajib diisi.',
            'link.url'         => 'Format tautan link berita tidak valid.',
            'tanggal.required' => 'Tanggal publikasi berita wajib diisi.',
            'gambar.image'     => 'Berkas harus berupa gambar (JPG, JPEG, PNG, WebP).',
            'gambar.max'       => 'Ukuran gambar berita maksimal 3MB.',
        ]);

        $data = [
            'judul'   => $request->judul,
            'link'    => $request->link,
            'tanggal' => $request->tanggal,
        ];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada di storage
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            } elseif ($berita->gambar && file_exists(public_path('images/' . $berita->gambar))) {
                @unlink(public_path('images/' . $berita->gambar));
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        try {
            Aktivitas::create([
                'judul'     => 'Pembaruan Berita',
                'deskripsi' => 'Berita diperbarui: ' . $berita->judul,
                'tipe'      => 'berita',
                'icon'      => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita dari database
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        } elseif ($berita->gambar && file_exists(public_path('images/' . $berita->gambar))) {
            @unlink(public_path('images/' . $berita->gambar));
        }

        $judul = $berita->judul;
        $berita->delete();

        try {
            Aktivitas::create([
                'judul'     => 'Penghapusan Berita',
                'deskripsi' => 'Berita dihapus: ' . $judul,
                'tipe'      => 'berita',
                'icon'      => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil dihapus.');
    }
}