<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organigram;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganigramController extends Controller
{
    private function kelompokOptions()
    {
        return [
            'Pimpinan',
            'Sekretariat',
            'Bidang Pembinaan, Pelestarian dan Pengembangan Kearsipan',
            'Bidang Pengelolaan dan Pemeliharaan Kearsipan',
            'Bidang Layanan dan Otomasi Perpustakaan',
            'Bidang Pengembangan dan Pelestarian Perpustakaan',
            'Bale Panyawangan Diorama',
        ];
    }

    /**
     * Tampilkan daftar organigram
     */
    public function index()
    {
        $organigram = Organigram::orderBy('id', 'asc')->get();

        return view('admin.organigram.index', compact('organigram'));
    }

    /**
     * Form tambah pengurus
     */
    public function create()
    {
        $kelompokOptions = $this->kelompokOptions();

        return view('admin.organigram.create', compact('kelompokOptions'));
    }

    /**
     * Simpan pengurus baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kelompok' => [
                'required',
                'string',
                Rule::in($this->kelompokOptions()),
            ],
        ], [
            'nama.required' => 'Nama pengurus wajib diisi.',
            'jabatan.required' => 'Jabatan pengurus wajib diisi.',
            'kelompok.required' => 'Kelompok organigram wajib dipilih.',
            'kelompok.in' => 'Kelompok organigram tidak valid.',
        ]);

        $organigram = Organigram::create($validated);

        try {
            Aktivitas::create([
                'judul' => 'Penambahan Struktur Organigram',
                'deskripsi' => 'Pengurus baru ditambahkan: ' . $organigram->nama . ' (' . $organigram->jabatan . ')',
                'tipe' => 'organigram',
                'icon' => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.organigram')
            ->with('success', 'Pengurus "' . $organigram->nama . '" berhasil ditambahkan ke organigram.');
    }

    /**
     * Form edit pengurus
     */
    public function edit($id)
    {
        $organigram = Organigram::findOrFail($id);
        $kelompokOptions = $this->kelompokOptions();

        return view('admin.organigram.edit', compact('organigram', 'kelompokOptions'));
    }

    /**
     * Perbarui data pengurus
     */
    public function update(Request $request, $id)
    {
        $organigram = Organigram::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kelompok' => [
                'required',
                'string',
                Rule::in($this->kelompokOptions()),
            ],
        ], [
            'nama.required' => 'Nama pengurus wajib diisi.',
            'jabatan.required' => 'Jabatan pengurus wajib diisi.',
            'kelompok.required' => 'Kelompok organigram wajib dipilih.',
            'kelompok.in' => 'Kelompok organigram tidak valid.',
        ]);

        $organigram->update($validated);

        try {
            Aktivitas::create([
                'judul' => 'Pembaruan Struktur Organigram',
                'deskripsi' => 'Data pengurus diperbarui: ' . $organigram->nama,
                'tipe' => 'organigram',
                'icon' => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.organigram')
            ->with('success', 'Data pengurus "' . $organigram->nama . '" berhasil diperbarui.');
    }

    /**
     * Hapus pengurus
     */
    public function destroy($id)
    {
        $organigram = Organigram::findOrFail($id);
        $nama = $organigram->nama;

        $organigram->delete();

        try {
            Aktivitas::create([
                'judul' => 'Penghapusan Struktur Organigram',
                'deskripsi' => 'Pengurus organigram dihapus: ' . $nama,
                'tipe' => 'organigram',
                'icon' => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.organigram')
            ->with('success', 'Pengurus "' . $nama . '" berhasil dihapus dari organigram.');
    }
}
