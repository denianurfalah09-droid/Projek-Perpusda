
@extends('admin.layouts.app')

@section('title', 'Fasilitas')

@section('content')

<div class="page-title">
    <h1>Fasilitas</h1>
    <p>Beranda / Fasilitas</p>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="fasilitas-header">
    <a href="{{ route('admin.fasilitas.create') }}" class="btn-primary">
        + &nbsp; Tambah Fasilitas
    </a>
</div>

<div class="table-container">
    <table class="admin-table fasilitas-table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Fasilitas</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($fasilitas as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nama_fasilitas }}</td>

                    <td>{{ $item->deskripsi }}</td>

                    <td>
                        <div class="action-buttons">
                            <a
                                href="{{ route('admin.fasilitas.edit', $item->id_fasilitas) }}"
                                class="btn-edit"
                            >
                                ✎
                            </a>

                            <form
                                action="{{ route('admin.fasilitas.destroy', $item->id_fasilitas) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-action btn-delete" title="Hapus Buku">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">
                        Belum ada data fasilitas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
