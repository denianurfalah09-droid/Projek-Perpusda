
@extends('admin.layouts.app')

@section('title', 'Edit Organigram')

@section('content')

<div class="page-title">
    <h1>Edit Organigram</h1>
    <p>Beranda / Organigram / Edit Organigram</p>
</div>

<div class="organigram-form">

    <form action="{{ route('admin.organigram.update', $organigram->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="organigram-form-group">

            <label for="nama">
                Nama
            </label>

            <input
                type="text"
                id="nama"
                name="nama"
                value="{{ old('nama', $organigram->nama) }}"
                placeholder="Masukan nama"
            >

            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div class="organigram-form-group">

            <label for="jabatan">
                Jabatan
            </label>

            <input
                type="text"
                id="jabatan"
                name="jabatan"
                value="{{ old('jabatan', $organigram->jabatan) }}"
                placeholder="Masukan jabatan"
            >

            @error('jabatan')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div class="organigram-form-group">

            <label for="kelompok">
                Kelompok
            </label>

            <select id="kelompok" name="kelompok">
                <option value="">Pilih Kelompok</option>

                @foreach ($kelompokOptions as $kelompok)
                    <option
                        value="{{ $kelompok }}"
                        {{ old('kelompok', $organigram->kelompok) == $kelompok ? 'selected' : '' }}
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
                Simpan perubahan
            </button>

        </div>

    </form>

</div>

@endsection
