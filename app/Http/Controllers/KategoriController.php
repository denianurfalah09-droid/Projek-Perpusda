<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Kategori;
use App\Models\Katalog;
use App\Models\Aktivitas;

class KategoriController extends Controller
{
    /**
     * Tampilkan daftar kategori dengan jumlah buku
     */
    public function index()
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('kategoris')) {
            try {
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                if (\Illuminate\Support\Facades\Schema::hasTable('kategoris')) {
                    \Illuminate\Support\Facades\Artisan::call('db:seed', [
                        '--class' => 'Database\\Seeders\\InitialDataSeeder',
                        '--force' => true
                    ]);
                }
            } catch (\Throwable $e) {}
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('kategoris')) {
            $kategori = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
            return view('admin.kategori.index', compact('kategori'));
        }

        $kategori = Kategori::withCount('buku')->latest()->paginate(10);
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori',
            'icon' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
            'icon' => $request->icon ?: '📚',
            'deskripsi' => $request->deskripsi,
        ]);

        Aktivitas::create([
            'judul' => 'Admin menambah kategori baru: ' . $kategori->nama_kategori,
            'deskripsi' => 'Kategori buku baru telah ditambahkan ke sistem',
            'tipe' => 'kategori',
            'icon' => 'tag',
        ]);

        return redirect()->route('admin.kategori')
            ->with('success', 'Kategori "' . $kategori->nama_kategori . '" berhasil ditambahkan!');
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
     * Update kategori
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori,' . $id,
            'icon' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $oldName = $kategori->nama_kategori;
        $newName = $request->nama_kategori;

        $kategori->update([
            'nama_kategori' => $newName,
            'slug' => Str::slug($newName),
            'icon' => $request->icon ?: $kategori->icon,
            'deskripsi' => $request->deskripsi,
        ]);

        // Perbarui juga nama kategori di tabel katalogs jika berubah
        if ($oldName !== $newName) {
            Katalog::where('kategori', $oldName)->update(['kategori' => $newName]);
        }

        Aktivitas::create([
            'judul' => 'Admin memperbarui kategori: ' . $newName,
            'deskripsi' => 'Kategori ' . $oldName . ' diperbarui menjadi ' . $newName,
            'tipe' => 'kategori',
            'icon' => 'edit',
        ]);

        return redirect()->route('admin.kategori')
            ->with('success', 'Kategori "' . $newName . '" berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $nama = $kategori->nama_kategori;

        // Cek apakah ada buku yang memakai kategori ini
        $countBuku = Katalog::where('kategori', $nama)->count();
        if ($countBuku > 0) {
            return back()->with('error', 'Kategori "' . $nama . '" tidak dapat dihapus karena masih digunakan oleh ' . $countBuku . ' buku.');
        }

        $kategori->delete();

        Aktivitas::create([
            'judul' => 'Admin menghapus kategori: ' . $nama,
            'deskripsi' => 'Kategori ' . $nama . ' telah dihapus dari sistem',
            'tipe' => 'kategori',
            'icon' => 'trash',
        ]);

        return redirect()->route('admin.kategori')
            ->with('success', 'Kategori "' . $nama . '" berhasil dihapus!');
    }
}
