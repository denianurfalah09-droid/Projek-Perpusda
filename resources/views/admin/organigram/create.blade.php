
@extends('admin.layouts.app')

@section('title', 'Tambah Organigram')

@section('content')

<div class="page-title">
    <h1>Tambah Organigram</h1>
    <p>Beranda / Organigram / Tambah Organigram</p>
</div>

<div class="organigram-form">

    <form action="{{ route('admin.organigram.store') }}" method="POST">
        @csrf

        <div class="organigram-form-group">
            <label for="nama">Nama</label>

            <input
                type="text"
                id="nama"
                name="nama"
                placeholder="Masukan nama"
                value="{{ old('nama') }}"
            >

            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="organigram-form-group">
            <label for="jabatan">Jabatan</label>

            <input
                type="text"
                id="jabatan"
                name="jabatan"
                placeholder="Masukan jabatan"
                value="{{ old('jabatan') }}"
            >

            @error('jabatan')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="organigram-form-group">
            <label for="kelompok">Kelompok</label>

            <select id="kelompok" name="kelompok">
                <option value="">Pilih Kelompok</option>

                @foreach ($kelompokOptions as $kelompok)
                    <option
                        value="{{ $kelompok }}"
                        {{ old('kelompok') == $kelompok ? 'selected' : '' }}
                    >
                        {{ $kelompok }}
                    </option>
                @endforeach
            </select>

            @error('kelompok')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="organigram-form-actions">

            <a
                href="{{ route('admin.organigram') }}"
                class="organigram-btn-cancel"
            >
                Batal
            </a>

            <button
                type="submit"
                class="organigram-btn-save"
            >
                Simpan
            </button>

        </div>
    </form>

</div>

@endsection