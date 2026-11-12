@extends('admin.layouts.app')

@section('title', 'Edit Katalog Buku')

@section('content')

<div class="page-title">
    <div>
        <h1>Edit Katalog Buku</h1>
        <p>Perbarui informasi atau sampul koleksi buku perpustakaan</p>
    </div>

    <div class="page-title-actions">
        <a href="{{ route('admin.katalog') }}" class="btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span>Kembali</span>
        </a>
    </div>
</div>

<div class="form-card">

    <form action="{{ route('admin.katalog.update', $buku->id) }}" method="POST" enctype="multipart/form-data" id="editBukuForm">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-left-col">

                <div class="form-group">
                    <label for="judul">Judul Buku <span class="required-mark">*</span></label>
                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        placeholder="Masukan judul buku"
                        value="{{ old('judul', $buku->judul) }}"
                        class="form-input @error('judul') input-error @enderror"
                        required
                    >
                    @error('judul')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="penulis">Penulis <span class="required-mark">*</span></label>
                        <input
                            type="text"
                            id="penulis"
                            name="penulis"
                            placeholder="Masukan nama penulis"
                            value="{{ old('penulis', $buku->penulis) }}"
                            class="form-input @error('penulis') input-error @enderror"
                            required
                        >
                        @error('penulis')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="penerbit">Penerbit <span class="required-mark">*</span></label>
                        <input
                            type="text"
                            id="penerbit"
                            name="penerbit"
                            placeholder="Masukan penerbit"
                            value="{{ old('penerbit', $buku->penerbit) }}"
                            class="form-input @error('penerbit') input-error @enderror"
                            required
                        >
                        @error('penerbit')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="tahun">Tahun Terbit <span class="required-mark">*</span></label>
                        <input
                            type="number"
                            id="tahun"
                            name="tahun"
                            placeholder="Masukan tahun"
                            min="1900"
                            max="2099"
                            value="{{ old('tahun', $buku->tahun) }}"
                            class="form-input @error('tahun') input-error @enderror"
                            required
                        >
                        @error('tahun')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori Buku <span class="required-mark">*</span></label>
                        <select name="kategori" id="kategori" class="form-input form-select @error('kategori') input-error @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoriList ?? ['Novel', 'Pendidikan', 'Agama', 'Sejarah', 'Biografi', 'Sains', 'Teknologi', 'Sastra', 'Umum'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $buku->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>

            <!-- FOTO SAMPUL BUKU DENGAN LIVE PREVIEW -->
            <div class="form-right-col">

                <div class="form-group">
                    <label>Foto / Sampul Buku</label>
                    <p class="field-hint">Pilih gambar baru untuk mengganti foto sampul buku saat ini</p>

                    <div class="upload-dropzone" id="dropzoneContainer">
                        <input
                            type="file"
                            id="gambar"
                            name="gambar"
                            accept="image/*"
                            onchange="previewBookImage(this)"
                            class="file-input-hidden"
                        >

                        @php
                            $hasExisting = $buku->gambar && file_exists(public_path('uploads/katalog/' . $buku->gambar));
                        @endphp

                        <div class="dropzone-idle" id="dropzoneIdle" style="{{ $hasExisting ? 'display: none;' : 'display: flex;' }}">
                            <div class="dropzone-icon">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            </div>
                            <strong>Pilih Foto Sampul Baru</strong>
                            <span>atau seret gambar ke sini</span>
                            <label for="gambar" class="btn-browse-file">Pilih Berkas</label>
                        </div>

                        <!-- LIVE PREVIEW CONTAINER -->
                        <div class="dropzone-preview" id="dropzonePreview" style="{{ $hasExisting ? 'display: block;' : 'display: none;' }}">
                            <img id="imagePreviewImg" src="{{ $hasExisting ? asset('uploads/katalog/' . $buku->gambar) : '#' }}" alt="Pratinjau Sampul" class="preview-img">
                            <div class="preview-overlay">
                                <label for="gambar" class="btn-change-img">Ganti Foto</label>
                                <button type="button" class="btn-remove-img" onclick="resetBookImage('{{ $hasExisting ? asset('uploads/katalog/' . $buku->gambar) : '' }}')">Reset</button>
                            </div>
                        </div>

                    </div>
                    @error('gambar')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>

        </div>

        <div class="form-card-footer">
            <a href="{{ route('admin.katalog') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                <span>Simpan Perubahan</span>
            </button>
        </div>

    </form>

</div>

<script>
    function previewBookImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imagePreviewImg').src = e.target.result;
                document.getElementById('dropzoneIdle').style.display = 'none';
                document.getElementById('dropzonePreview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetBookImage(defaultSrc) {
        const input = document.getElementById('gambar');
        input.value = "";
        if (defaultSrc) {
            document.getElementById('imagePreviewImg').src = defaultSrc;
            document.getElementById('dropzonePreview').style.display = 'block';
            document.getElementById('dropzoneIdle').style.display = 'none';
        } else {
            document.getElementById('imagePreviewImg').src = "#";
            document.getElementById('dropzonePreview').style.display = 'none';
            document.getElementById('dropzoneIdle').style.display = 'flex';
        }
    }
</script>

@endsection