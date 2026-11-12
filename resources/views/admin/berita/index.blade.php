@extends('admin.layouts.app')

@section('title', 'Berita')
@section('breadcrumb', 'Beranda / Berita')

@section('content')

<div class="page-title">
    <h1>Berita</h1>
    <p>Beranda / Berita</p>
</div>

<div class="berita-header">
    <a href="{{ route('admin.berita.create') }}" class="btn-primary">
        +&nbsp; Tambah Berita
    </a>
</div>

<div class="table-container">

    <table class="admin-table berita-table">

        <thead>
            <tr>
                <th>NO</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($berita as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $item->judul }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}
                    </td>

                    <td>
                        @if ($item->gambar)
                            <img
                                src="{{ asset('images/' . $item->gambar) }}"
                                alt="{{ $item->judul }}"
                                class="berita-image"
                            >
                        @else
                            <div class="berita-image-placeholder">
                                Gambar
                            </div>
                        @endif
                    </td>

                    <td>
                        <div class="action-buttons">

                            <a
                                href="{{ route('admin.berita.edit', $item->id) }}"
                                class="btn-edit"
                                title="Edit"
                            >
                                ✎
                            </a>

                            <button
                                type="button"
                                class="btn-delete"
                                title="Hapus"
                            >
                                ×
                            </button>

                        </div>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="5" style="text-align:center; padding:30px;">
                        Belum ada berita.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection