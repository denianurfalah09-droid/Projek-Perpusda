<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Katalog;
use App\Models\Kategori;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
{
    /**
     * Tampilkan daftar katalog buku dengan filter dan pencarian
     */
    public function index(Request $request)
    {
        $query = Katalog::latest();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('penulis', 'like', "%{$keyword}%")
                  ->orWhere('penerbit', 'like', "%{$keyword}%");
            });
        }

        $buku = $query->paginate(10)->withQueryString();
        $kategoriList = Kategori::orderBy('nama_kategori')->pluck('nama_kategori')->toArray();

        return view('admin.katalog.index', compact('buku', 'kategoriList'));
    }

    /**
     * Form tambah katalog buku baru
     */
    public function create()
    {
        $kategoriList = Kategori::orderBy('nama_kategori')->pluck('nama_kategori')->toArray();

        return view('admin.katalog.create', compact('kategoriList'));
    }

    /**
     * Simpan buku baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'penulis'  => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun'    => 'required|digits:4',
            'kategori' => 'required|string|max:100',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'judul.required'    => 'Judul buku wajib diisi.',
            'penulis.required'  => 'Penulis buku wajib diisi.',
            'penerbit.required' => 'Penerbit buku wajib diisi.',
            'tahun.required'    => 'Tahun terbit buku wajib diisi.',
            'tahun.digits'      => 'Tahun terbit harus 4 digit angka.',
            'kategori.required' => 'Kategori buku wajib dipilih.',
            'gambar.image'      => 'Berkas harus berupa gambar (JPG, JPEG, PNG, WebP).',
            'gambar.max'        => 'Ukuran cover buku maksimal 5MB.',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('katalog', 'public');
        }

        $buku = Katalog::create([
            'judul'    => $request->judul,
            'penulis'  => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun'    => $request->tahun,
            'kategori' => $request->kategori,
            'gambar'   => $gambarPath,
        ]);

        try {
            Aktivitas::create([
                'judul'     => 'Penambahan Buku Katalog',
                'deskripsi' => 'Buku baru ditambahkan: ' . $buku->judul,
                'tipe'      => 'katalog',
                'icon'      => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.katalog')
            ->with('success', 'Buku "' . $buku->judul . '" berhasil ditambahkan ke katalog.');
    }

    /**
     * Form edit katalog buku
     */
    public function edit($id)
    {
        $buku = Katalog::findOrFail($id);
        $kategoriList = Kategori::orderBy('nama_kategori')->pluck('nama_kategori')->toArray();

        return view('admin.katalog.edit', compact('buku', 'kategoriList'));
    }

    /**
     * Perbarui data buku katalog
     */
    public function update(Request $request, $id)
    {
        $buku = Katalog::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'penulis'  => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun'    => 'required|digits:4',
            'kategori' => 'required|string|max:100',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'judul.required'    => 'Judul buku wajib diisi.',
            'penulis.required'  => 'Penulis buku wajib diisi.',
            'penerbit.required' => 'Penerbit buku wajib diisi.',
            'tahun.required'    => 'Tahun terbit buku wajib diisi.',
            'tahun.digits'      => 'Tahun terbit harus 4 digit angka.',
            'kategori.required' => 'Kategori buku wajib dipilih.',
            'gambar.image'      => 'Berkas harus berupa gambar (JPG, JPEG, PNG, WebP).',
            'gambar.max'        => 'Ukuran cover buku maksimal 5MB.',
        ]);

        $data = [
            'judul'    => $request->judul,
            'penulis'  => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun'    => $request->tahun,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('gambar')) {
            if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
                Storage::disk('public')->delete($buku->gambar);
            }
            if ($buku->gambar && file_exists(public_path('uploads/katalog/' . $buku->gambar))) {
                @unlink(public_path('uploads/katalog/' . $buku->gambar));
            }
            $data['gambar'] = $request->file('gambar')->store('katalog', 'public');
        }

        $buku->update($data);

        try {
            Aktivitas::create([
                'judul'     => 'Pembaruan Buku Katalog',
                'deskripsi' => 'Data buku katalog diperbarui: ' . $buku->judul,
                'tipe'      => 'katalog',
                'icon'      => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.katalog')
            ->with('success', 'Buku "' . $buku->judul . '" berhasil diperbarui.');
    }

    /**
     * Hapus buku dari katalog
     */
    public function destroy($id)
    {
        $buku = Katalog::findOrFail($id);

        if ($buku->gambar) {
            if (Storage::disk('public')->exists($buku->gambar)) {
                Storage::disk('public')->delete($buku->gambar);
            }
            if (file_exists(public_path('uploads/katalog/' . $buku->gambar))) {
                @unlink(public_path('uploads/katalog/' . $buku->gambar));
            }
        }

        $judul = $buku->judul;
        $buku->delete();

        try {
            Aktivitas::create([
                'judul'     => 'Penghapusan Buku Katalog',
                'deskripsi' => 'Buku katalog dihapus: ' . $judul,
                'tipe'      => 'katalog',
                'icon'      => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.katalog')
            ->with('success', 'Buku "' . $judul . '" berhasil dihapus dari katalog.');
    }
}

