<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katalog;
use App\Models\Kategori;
use App\Models\Aktivitas;
use Illuminate\Support\Facades\File;

class KatalogController extends Controller
{
    /**
     * Tampilkan daftar buku di admin dengan filter dan pagination
     */
    public function index(Request $request)
    {
        $query = Katalog::latest();

        // Filter pencarian judul/penulis/penerbit
        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('penulis', 'like', "%{$keyword}%")
                  ->orWhere('penerbit', 'like', "%{$keyword}%");
            });
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }

        $buku = $query->paginate(10)->withQueryString();

        // Ambil semua nama kategori untuk dropdown filter
        $kategoriList = [];
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('kategoris')) {
                $kategoriList = Kategori::orderBy('nama_kategori')->pluck('nama_kategori')->toArray();
            }
        } catch (\Throwable $e) {}

        if (empty($kategoriList)) {
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('katalogs')) {
                    $kategoriList = Katalog::distinct('kategori')->pluck('kategori')->filter()->toArray();
                }
            } catch (\Throwable $e) {}
        }

        if (empty($kategoriList)) {
            $kategoriList = ['Novel', 'Pendidikan', 'Agama', 'Sejarah', 'Biografi', 'Sains', 'Teknologi', 'Sastra', 'Umum'];
        }

        return view('admin.katalog.index', compact('buku', 'kategoriList'));
    }

    /**
     * Form tambah buku baru
     */
    public function create()
    {
        $kategoriList = [];
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('kategoris')) {
                $kategoriList = Kategori::orderBy('nama_kategori')->pluck('nama_kategori')->toArray();
            }
        } catch (\Throwable $e) {}

        if (empty($kategoriList)) {
            $kategoriList = ['Novel', 'Pendidikan', 'Agama', 'Sejarah', 'Biografi', 'Sains', 'Teknologi', 'Sastra', 'Umum'];
        }

        return view('admin.katalog.create', compact('kategoriList'));
    }

    /**
     * Simpan data buku baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|string|max:10',
            'kategori' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ], [
            'judul.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'penerbit.required' => 'Nama penerbit wajib diisi.',
            'tahun.required' => 'Tahun terbit wajib diisi.',
            'kategori.required' => 'Kategori buku wajib dipilih.',
            'gambar.image' => 'Berkas sampul harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/katalog');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            $file->move($destinationPath, $filename);
            $data['gambar'] = $filename;
        }

        $buku = Katalog::create($data);

        // Catat ke aktivitas terbaru
        Aktivitas::create([
            'judul' => 'Admin menambahkan buku baru: ' . $buku->judul,
            'deskripsi' => 'Buku kategori ' . $buku->kategori . ' karya ' . $buku->penulis . ' berhasil ditambahkan ke katalog',
            'tipe' => 'katalog',
            'icon' => 'plus',
        ]);

        return redirect()->route('admin.katalog')->with('success', 'Buku "' . $buku->judul . '" berhasil ditambahkan ke katalog!');
    }

    /**
     * Form edit buku
     */
    public function edit($id)
    {
        $buku = Katalog::findOrFail($id);

        $kategoriList = [];
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('kategoris')) {
                $kategoriList = Kategori::orderBy('nama_kategori')->pluck('nama_kategori')->toArray();
            }
        } catch (\Throwable $e) {}

        if (empty($kategoriList)) {
            $kategoriList = ['Novel', 'Pendidikan', 'Agama', 'Sejarah', 'Biografi', 'Sains', 'Teknologi', 'Sastra', 'Umum'];
        }

        return view('admin.katalog.edit', compact('buku', 'kategoriList'));
    }

    /**
     * Perbarui data buku
     */
    public function update(Request $request, $id)
    {
        $buku = Katalog::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|string|max:10',
            'kategori' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ], [
            'judul.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'penerbit.required' => 'Nama penerbit wajib diisi.',
            'tahun.required' => 'Tahun terbit wajib diisi.',
            'kategori.required' => 'Kategori buku wajib dipilih.',
            'gambar.image' => 'Berkas sampul harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/katalog');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            $file->move($destinationPath, $filename);

            // Hapus file cover lama jika ada
            if ($buku->gambar && File::exists(public_path('uploads/katalog/' . $buku->gambar))) {
                File::delete(public_path('uploads/katalog/' . $buku->gambar));
            }

            $data['gambar'] = $filename;
        }

        $buku->update($data);

        // Catat ke aktivitas terbaru
        Aktivitas::create([
            'judul' => 'Admin memperbarui buku: ' . $buku->judul,
            'deskripsi' => 'Data buku "' . $buku->judul . '" berhasil diperbarui',
            'tipe' => 'katalog',
            'icon' => 'edit',
        ]);

        return redirect()->route('admin.katalog')->with('success', 'Buku "' . $buku->judul . '" berhasil diperbarui!');
    }

    /**
     * Hapus buku dari katalog
     */
    public function destroy($id)
    {
        $buku = Katalog::findOrFail($id);
        $judulBuku = $buku->judul;

        if ($buku->gambar && File::exists(public_path('uploads/katalog/' . $buku->gambar))) {
            File::delete(public_path('uploads/katalog/' . $buku->gambar));
        }

        $buku->delete();

        // Catat ke aktivitas terbaru
        Aktivitas::create([
            'judul' => 'Admin menghapus buku: ' . $judulBuku,
            'deskripsi' => 'Buku "' . $judulBuku . '" telah dihapus dari katalog',
            'tipe' => 'katalog',
            'icon' => 'trash',
        ]);

        return redirect()->route('admin.katalog')->with('success', 'Buku "' . $judulBuku . '" berhasil dihapus dari katalog!');
    }
}
