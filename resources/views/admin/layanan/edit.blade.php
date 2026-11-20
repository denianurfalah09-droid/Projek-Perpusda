
@extends('admin.layouts.app')

@section('title', 'Edit Layanan')

@section('content')

<div class="page-title">
    <h1>Edit Layanan</h1>
    <p>Beranda / Layanan / Edit Layanan</p>
</div>

<div class="layanan-form">

    <form action="{{ route('admin.layanan.update', $layanan->id_layanan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="layanan-form-group">
            <label for="nama_layanan">Nama Layanan</label>

            <input
                type="text"
                id="nama_layanan"
                name="nama_layanan"
                value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
                placeholder="Masukan nama layanan"
                required
            >

            @error('nama_layanan')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="layanan-form-group">
            <label for="deskripsi">Deskripsi</label>

            <textarea
                id="deskripsi"
                name="deskripsi"
                placeholder="Masukan deskripsi layanan"
                required
            >{{ old('deskripsi', $layanan->deskripsi) }}</textarea>

            @error('deskripsi')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="layanan-form-actions">
            <a href="{{ route('admin.layanan') }}" class="layanan-btn-cancel">
                Batal
            </a>

            <button type="submit" class="layanan-btn-save">
                Simpan perubahan
            </button>
        </div>
    </form>

</div>

@endsection
