<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Katalog;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Tampilkan daftar kategori buku
     */
    public function index()
    {
        $kategori = Kategori::withCount('buku')->orderBy('nama_kategori')->paginate(10);

        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Form tambah kategori baru
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Simpan kategori baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori',
            'icon'          => 'nullable|string|max:50',
            'deskripsi'     => 'nullable|string|max:500',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Kategori dengan nama tersebut sudah terdaftar.',
        ]);

        $slug = Str::slug($request->nama_kategori);
        $count = Kategori::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug = "{$slug}-" . ($count + 1);
        }

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug'          => $slug,
            'icon'          => $request->icon ?? '📚',
            'deskripsi'     => $request->deskripsi,
        ]);

        try {
            Aktivitas::create([
                'judul'     => 'Penambahan Kategori Buku',
                'deskripsi' => 'Kategori baru ditambahkan: ' . $kategori->nama_kategori,
                'tipe'      => 'kategori',
                'icon'      => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.kategori')
            ->with('success', 'Kategori "' . $kategori->nama_kategori . '" berhasil ditambahkan.');
    }

    /**
     * Form edit kategori
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Perbarui data kategori
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori,' . $id,
            'icon'          => 'nullable|string|max:50',
            'deskripsi'     => 'nullable|string|max:500',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Kategori dengan nama tersebut sudah terdaftar.',
        ]);

        $oldName = $kategori->nama_kategori;
        $newName = $request->nama_kategori;

        $slug = Str::slug($newName);
        $count = Kategori::where('slug', 'like', "{$slug}%")->where('id', '!=', $id)->count();
        if ($count > 0) {
            $slug = "{$slug}-" . ($count + 1);
        }

        $kategori->update([
            'nama_kategori' => $newName,
            'slug'          => $slug,
            'icon'          => $request->icon ?? '📚',
            'deskripsi'     => $request->deskripsi,
        ]);

        // Jika nama kategori berubah, sinkronkan nama kategori di tabel katalogs
        if ($oldName !== $newName) {
            Katalog::where('kategori', $oldName)->update(['kategori' => $newName]);
        }

        try {
            Aktivitas::create([
                'judul'     => 'Pembaruan Kategori Buku',
                'deskripsi' => 'Kategori diperbarui: ' . $kategori->nama_kategori,
                'tipe'      => 'kategori',
                'icon'      => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.kategori')
            ->with('success', 'Kategori "' . $kategori->nama_kategori . '" berhasil diperbarui.');
    }

    /**
     * Hapus kategori dari database
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Validasi relasi: cek apakah kategori masih dipakai buku
        $bukuCount = Katalog::where('kategori', $kategori->nama_kategori)->count();
        if ($bukuCount > 0) {
            return back()->with('error', 'Kategori "' . $kategori->nama_kategori . '" tidak dapat dihapus karena masih digunakan oleh ' . $bukuCount . ' buku katalog.');
        }

        $nama = $kategori->nama_kategori;
        $kategori->delete();

        try {
            Aktivitas::create([
                'judul'     => 'Penghapusan Kategori Buku',
                'deskripsi' => 'Kategori dihapus: ' . $nama,
                'tipe'      => 'kategori',
                'icon'      => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.kategori')
            ->with('success', 'Kategori "' . $nama . '" berhasil dihapus.');
    }
}