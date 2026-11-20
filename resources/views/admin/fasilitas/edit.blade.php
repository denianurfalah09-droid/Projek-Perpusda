
@extends('admin.layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')

<div class="page-title">
    <h1>Edit Fasilitas</h1>
    <p>Beranda / Fasilitas / Edit Fasilitas</p>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form
    action="{{ route('admin.fasilitas.update', $fasilitas->id_fasilitas) }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <div class="fasilitas-form">

        <div class="fasilitas-form-group">
            <label for="nama_fasilitas">
                Nama Fasilitas
            </label>

            <input
                type="text"
                id="nama_fasilitas"
                name="nama_fasilitas"
                value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}"
                placeholder="Masukkan nama fasilitas"
                required
            >
        </div>

        <div class="fasilitas-form-group">
            <label for="deskripsi">
                Deskripsi
            </label>

            <textarea
                id="deskripsi"
                name="deskripsi"
                placeholder="Masukkan deskripsi fasilitas"
                required
            >{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>
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
                Simpan Perubahan
            </button>
        </div>

    </div>
</form>

@endsection
