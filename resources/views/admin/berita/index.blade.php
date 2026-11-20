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
                            @if (\Illuminate\Support\Str::startsWith($item->gambar, ['http://', 'https://']))
                                <img src="{{ $item->gambar }}" alt="{{ $item->judul }}" class="berita-image">
                            @elseif (file_exists(public_path('storage/' . $item->gambar)))
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="berita-image">
                            @elseif (file_exists(public_path('images/' . $item->gambar)))
                                <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->judul }}" class="berita-image">
                            @else
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="berita-image">
                            @endif
                        @else
                            <div class="berita-image-placeholder">
                                Gambar
                            </div>
                        @endif
                    </td>

                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.berita.edit', $item->id) }}"
                            class="btn-action btn-edit"
                            title="Edit Berita">
                                <svg width="15" height="15" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2.2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </a>

                            <form action="{{ route('admin.berita.destroy', $item->id) }}"
                                method="POST"
                                class="form-delete-inline"
                                onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn-action btn-delete"
                                        title="Hapus Berita">
                                    <svg width="15" height="15" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </form>
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