@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')

@section('content')

<div class="page-title">
    <h1>Tambah Layanan</h1>
    <p>Beranda / Layanan / Tambah Layanan</p>
</div>

<div class="layanan-form">

    <div class="layanan-form-group">

        <label for="nama_layanan">
            Nama Layanan
        </label>

        <input
            type="text"
            id="nama_layanan"
            name="nama_layanan"
            placeholder="Masukan nama layanan"
        >

    </div>


    <div class="layanan-form-group">

        <label for="deskripsi">
            Deskripsi
        </label>

        <textarea
            id="deskripsi"
            name="deskripsi"
            placeholder="Masukan deskripsi layanan"
        ></textarea>

    </div>


    <div class="layanan-form-actions">

        <a
            href="{{ route('admin.layanan') }}"
            class="layanan-btn-cancel"
        >
            Batal
        </a>

        <button
            type="submit"
            class="layanan-btn-save"
        >
            Simpan
        </button>

    </div>

</div>

@endsection