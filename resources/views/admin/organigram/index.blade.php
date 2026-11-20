
@extends('admin.layouts.app')

@section('title', 'Organigram')

@section('content')

<div class="page-title">
    <h1>Organigram</h1>
    <p>Beranda / Organigram</p>
</div>

<div class="organigram-header">
    <a href="{{ route('admin.organigram.create') }}" class="btn-primary">
        + &nbsp; Tambah Organigram
    </a>
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

<div class="table-container">
    <table class="admin-table organigram-table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Kelompok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($organigram as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jabatan }}</td>
                    <td>{{ $item->kelompok }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.organigram.edit', $item->id) }}"
                               class="btn-edit"
                               title="Edit">
                                ✎
                            </a>

                            <form action="{{ route('admin.organigram.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn-delete"
                                        title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="18"
                                         height="18"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M8 6V4h8v2"/>
                                        <path d="m19 6-1 14H6L5 6"/>
                                        <path d="M10 11v5"/>
                                        <path d="M14 11v5"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">
                        Belum ada data organigram.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
