<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::orderBy('id_fasilitas', 'asc')->get();

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ], [
            'nama_fasilitas.required' => 'Nama fasilitas wajib diisi.',
            'deskripsi.required' => 'Deskripsi fasilitas wajib diisi.',
        ]);

        $fasilitas = Fasilitas::create([
            'nama_fasilitas' => $request->nama_fasilitas,
            'deskripsi' => $request->deskripsi,
        ]);

        try {
            Aktivitas::create([
                'judul' => 'Penambahan Fasilitas',
                'deskripsi' => 'Fasilitas baru ditambahkan: ' . $fasilitas->nama_fasilitas,
                'tipe' => 'fasilitas',
                'icon' => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.fasilitas')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ], [
            'nama_fasilitas.required' => 'Nama fasilitas wajib diisi.',
            'deskripsi.required' => 'Deskripsi fasilitas wajib diisi.',
        ]);

        $fasilitas->update([
            'nama_fasilitas' => $request->nama_fasilitas,
            'deskripsi' => $request->deskripsi,
        ]);

        try {
            Aktivitas::create([
                'judul' => 'Pembaruan Fasilitas',
                'deskripsi' => 'Fasilitas diperbarui: ' . $fasilitas->nama_fasilitas,
                'tipe' => 'fasilitas',
                'icon' => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.fasilitas')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $nama = $fasilitas->nama_fasilitas;
        $fasilitas->delete();

        try {
            Aktivitas::create([
                'judul' => 'Penghapusan Fasilitas',
                'deskripsi' => 'Fasilitas dihapus: ' . $nama,
                'tipe' => 'fasilitas',
                'icon' => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.fasilitas')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}
