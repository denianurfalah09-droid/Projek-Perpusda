
@extends('admin.layouts.app')

@section('title', 'Tambah Berita')

@section('breadcrumb', 'Berita / Tambah Berita')

@section('content')

<div class="page-title">
    <h1>Tambah Berita</h1>
    <p>Beranda / Berita / Tambah Berita</p>
</div>

<form
    action="{{ route('admin.berita.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="form-container berita-form"
>
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label for="link">Link Berita</label>

        <input
            type="url"
            id="link"
            name="link"
            placeholder="Masukkan link berita"
            value="{{ old('link') }}"
            required
        >

        <div style="margin-top: 10px; display: flex; gap: 8px;">
            <button type="button" id="btnPreview" class="btn-save">
                Ambil Preview
            </button>
            <button type="button" id="btnManual" class="btn-cancel">
                Input Form Manual
            </button>
        </div>
    </div>

    <div id="previewMessage" style="margin: 12px 0;"></div>

    <div id="previewContainer" style="display: {{ old('judul') || $errors->any() ? 'block' : 'none' }}; margin-top: 20px;">

        <h3>Detail Berita</h3>

        <div style="margin-bottom: 15px;">
            <img
                id="previewGambar"
                src="{{ old('gambar') }}"
                alt="Preview gambar berita"
                style="{{ old('gambar') ? 'display: block;' : 'display: none;' }} width: 100%; max-width: 400px; border-radius: 8px;"
            >
        </div>

        <div class="form-group">
            <label for="judul">Judul Berita</label>
            <input
                type="text"
                id="judul"
                name="judul"
                value="{{ old('judul') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Berita</label>
            <textarea
                id="deskripsi"
                name="deskripsi"
                rows="4"
            >{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal Publikasi</label>
            <input
                type="date"
                id="tanggal"
                name="tanggal"
                value="{{ old('tanggal') }}"
                required
            >
        </div>

        <input type="hidden" id="gambar" name="gambar" value="{{ old('gambar') }}">

        <div class="form-group">
            <label for="gambar_file">Atau Unggah Gambar Sendiri (Opsional)</label>
            <input
                type="file"
                id="gambar_file"
                name="gambar_file"
                accept="image/*"
            >
        </div>

        <div class="form-actions">

            <a href="{{ route('admin.berita') }}" class="btn-cancel">
                Batal
            </a>

            <button type="submit" class="btn-save">
                Simpan Berita
            </button>

        </div>

    </div>

</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnPreview = document.getElementById('btnPreview');
    const linkInput = document.getElementById('link');
    const previewContainer = document.getElementById('previewContainer');
    const previewMessage = document.getElementById('previewMessage');

    btnPreview.addEventListener('click', async function () {
        const link = linkInput.value.trim();

        if (!link) {
            previewMessage.textContent = 'Masukkan link berita terlebih dahulu.';
            return;
        }

        btnPreview.disabled = true;
        btnPreview.textContent = 'Mengambil data...';
        previewMessage.textContent = '';
        previewContainer.style.display = 'none';

        try {
            const response = await fetch(
                @json(route('admin.berita.preview')),
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': @json(csrf_token())
                    },
                    body: JSON.stringify({ link: link })
                }
            );

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Gagal mengambil preview.');
            }

            const data = result.data;

            document.getElementById('judul').value = data.judul || '';
            document.getElementById('deskripsi').value = data.deskripsi || '';
            document.getElementById('tanggal').value = data.tanggal || '';
            document.getElementById('gambar').value = data.gambar || '';

            const gambar = document.getElementById('previewGambar');

            if (data.gambar) {
                gambar.src = data.gambar;
                gambar.style.display = 'block';

                gambar.onerror = function () {
                    gambar.style.display = 'none';
                };
            } else {
                gambar.src = '';
                gambar.style.display = 'none';
            }

            previewContainer.style.display = 'block';
            previewMessage.textContent = 'Preview berhasil diambil. Periksa kembali datanya sebelum disimpan.';

        } catch (error) {
            previewMessage.textContent = error.message;
        } finally {
            btnPreview.disabled = false;
            btnPreview.textContent = 'Ambil Preview';
        }
    });

    const btnManual = document.getElementById('btnManual');
    if (btnManual) {
        btnManual.addEventListener('click', function () {
            previewContainer.style.display = 'block';
            previewMessage.textContent = 'Silakan isi detail berita secara manual.';
        });
    }
});
</script>

<style>
    .berita-form .btn-save {
        background-color: #064b9b !important;
        color: #ffffff !important;
        border: none !important;
        padding: 12px 24px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
    }

    .berita-form .btn-save:hover {
        background-color: #043875 !important;
    }
</style>

@endsection
