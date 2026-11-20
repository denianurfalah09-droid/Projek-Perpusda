
@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')

@section('content')

<div class="page-title">
    <h1>Tambah Layanan</h1>
    <p>Beranda / Layanan / Tambah Layanan</p>
</div>

<div class="layanan-form">

    <form action="{{ route('admin.layanan.store') }}" method="POST">
        @csrf

        <div class="layanan-form-group">
            <label for="nama_layanan">Nama Layanan</label>

            <input
                type="text"
                id="nama_layanan"
                name="nama_layanan"
                value="{{ old('nama_layanan') }}"
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
            >{{ old('deskripsi') }}</textarea>

            @error('deskripsi')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="layanan-form-actions">
            <a href="{{ route('admin.layanan') }}" class="layanan-btn-cancel">
                Batal
            </a>

            <button type="submit" class="layanan-btn-save">
                Simpan
            </button>
        </div>
    </form>

</div>

@endsection
