<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Tampilkan daftar layanan perpustakaan
     */
    public function index()
    {
        $layanan = Layanan::orderBy('id_layanan', 'desc')->get();

        return view('admin.layanan.index', compact('layanan'));
    }

    /**
     * Form tambah layanan baru
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * Simpan layanan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi'    => 'required|string',
        ], [
            'nama_layanan.required' => 'Nama layanan wajib diisi.',
            'deskripsi.required'    => 'Deskripsi layanan wajib diisi.',
        ]);

        $layanan = Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
        ]);

        try {
            Aktivitas::create([
                'judul'     => 'Penambahan Layanan',
                'deskripsi' => 'Layanan baru ditambahkan: ' . $layanan->nama_layanan,
                'tipe'      => 'layanan',
                'icon'      => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.layanan')
            ->with('success', 'Layanan "' . $layanan->nama_layanan . '" berhasil ditambahkan.');
    }

    /**
     * Form edit layanan
     */
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * Perbarui data layanan
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi'    => 'required|string',
        ], [
            'nama_layanan.required' => 'Nama layanan wajib diisi.',
            'deskripsi.required'    => 'Deskripsi layanan wajib diisi.',
        ]);

        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
        ]);

        try {
            Aktivitas::create([
                'judul'     => 'Pembaruan Layanan',
                'deskripsi' => 'Layanan diperbarui: ' . $layanan->nama_layanan,
                'tipe'      => 'layanan',
                'icon'      => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.layanan')
            ->with('success', 'Layanan "' . $layanan->nama_layanan . '" berhasil diperbarui.');
    }

    /**
     * Hapus layanan dari database
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $nama = $layanan->nama_layanan;
        $layanan->delete();

        try {
            Aktivitas::create([
                'judul'     => 'Penghapusan Layanan',
                'deskripsi' => 'Layanan dihapus: ' . $nama,
                'tipe'      => 'layanan',
                'icon'      => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.layanan')
            ->with('success', 'Layanan "' . $nama . '" berhasil dihapus.');
    }
}

