<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organigram;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class OrganigramController extends Controller
{
    /**
     * Tampilkan struktur organigram
     */
    public function index()
    {
        $organigram = Organigram::orderBy('id', 'asc')->get();

        return view('admin.organigram.index', compact('organigram'));
    }

    /**
     * Form tambah pengurus organigram
     */
    public function create()
    {
        return view('admin.organigram.create');
    }

    /**
     * Simpan pengurus baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ], [
            'nama.required'    => 'Nama pengurus wajib diisi.',
            'jabatan.required' => 'Jabatan pengurus wajib diisi.',
        ]);

        $organigram = Organigram::create([
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
        ]);

        try {
            Aktivitas::create([
                'judul'     => 'Penambahan Struktur Organigram',
                'deskripsi' => 'Pengurus baru ditambahkan: ' . $organigram->nama . ' (' . $organigram->jabatan . ')',
                'tipe'      => 'organigram',
                'icon'      => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.organigram')
            ->with('success', 'Pengurus "' . $organigram->nama . '" berhasil ditambahkan ke organigram.');
    }

    /**
     * Form edit pengurus organigram
     */
    public function edit($id)
    {
        $organigram = Organigram::findOrFail($id);

        return view('admin.organigram.edit', compact('organigram'));
    }

    /**
     * Perbarui data pengurus organigram
     */
    public function update(Request $request, $id)
    {
        $organigram = Organigram::findOrFail($id);

        $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ], [
            'nama.required'    => 'Nama pengurus wajib diisi.',
            'jabatan.required' => 'Jabatan pengurus wajib diisi.',
        ]);

        $organigram->update([
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
        ]);

        try {
            Aktivitas::create([
                'judul'     => 'Pembaruan Struktur Organigram',
                'deskripsi' => 'Data pengurus diperbarui: ' . $organigram->nama,
                'tipe'      => 'organigram',
                'icon'      => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.organigram')
            ->with('success', 'Data pengurus "' . $organigram->nama . '" berhasil diperbarui.');
    }

    /**
     * Hapus pengurus organigram dari database
     */
    public function destroy($id)
    {
        $organigram = Organigram::findOrFail($id);
        $nama = $organigram->nama;
        $organigram->delete();

        try {
            Aktivitas::create([
                'judul'     => 'Penghapusan Struktur Organigram',
                'deskripsi' => 'Pengurus organigram dihapus: ' . $nama,
                'tipe'      => 'organigram',
                'icon'      => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.organigram')
            ->with('success', 'Pengurus "' . $nama . '" berhasil dihapus dari organigram.');
    }
}

