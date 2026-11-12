@extends('admin.layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')

<div class="page-title">
    <h1>Edit Fasilitas</h1>
    <p>Beranda / Fasilitas / Edit Fasilitas</p>
</div>

<div class="fasilitas-form">

    <div class="fasilitas-form-group">

        <label for="nama_fasilitas">
            Nama Fasilitas
        </label>

        <input
            type="text"
            id="nama_fasilitas"
            name="nama_fasilitas"
            value="Ruang lobby"
            placeholder="Masukan nama fasilitas"
        >

    </div>


    <div class="fasilitas-form-group">

        <label for="deskripsi">
            Isi Profil
        </label>

        <textarea
            id="deskripsi"
            name="deskripsi"
            placeholder="Masukan isi profil fasilitas"
        >Ruang lobby perpustakaan sebagai area penerima pengunjung.</textarea>

    </div>


    <div class="fasilitas-form-group fasilitas-upload">

        <label for="gambar">
            Gambar
        </label>

        <input
            type="file"
            id="gambar"
            name="gambar"
        >

        <label
            for="gambar"
            class="choose-image"
        >
            Pilih gambar
        </label>

    </div>


    <div class="fasilitas-form-actions">

        <a
            href="{{ route('admin.fasilitas') }}"
            class="fasilitas-btn-cancel"
        >
            Batal
        </a>

        <button
            type="submit"
            class="fasilitas-btn-save"
        >
            Simpan perubahan
        </button>

    </div>

</div>

@endsection