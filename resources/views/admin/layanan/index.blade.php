
@extends('admin.layouts.app')

@section('title', 'Layanan')

@section('content')

<div class="page-title">
    <h1>Layanan</h1>
    <p>Beranda / Layanan</p>
</div>

<div class="layanan-header">
    <a href="{{ route('admin.layanan.create') }}" class="btn-primary">
        + &nbsp; Tambah Layanan
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-container">
    <table class="admin-table layanan-table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Layanan</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($layanan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_layanan }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.layanan.edit', $item->id_layanan) }}"
                               class="btn-edit"
                               title="Edit Layanan">
                                ✎
                            </a>

                            <form action="{{ route('admin.layanan.destroy', $item->id_layanan) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus Layanan">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">
                        Belum ada data layanan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
