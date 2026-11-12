@extends('admin.layouts.app')

@section('title', 'Kategori Buku')

@section('content')

<div class="page-title">
    <div>
        <h1>Kategori Buku</h1>
        <p>Kelola klasifikasi dan pengkategorian koleksi buku perpustakaan</p>
    </div>

    <div class="page-title-actions">
        <a href="{{ route('admin.kategori.create') }}" class="btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Tambah Kategori Baru</span>
        </a>
    </div>
</div>

<div class="table-card">

    <div class="table-card-header">
        <div class="table-card-title">
            <h3>Daftar Kategori</h3>
            <span class="badge-count">{{ $kategori->total() }} Kategori</span>
        </div>
    </div>

    <div class="table-container">

        <table class="admin-table kategori-table">

            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 70px; text-align: center;">Icon</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th>Jumlah Koleksi Buku</th>
                    <th style="width: 110px; text-align: center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kategori as $index => $item)
                    <tr>
                        <td class="text-center font-medium">{{ ($kategori->currentPage() - 1) * $kategori->perPage() + $index + 1 }}</td>
                        <td style="text-align: center; font-size: 20px;">{{ $item->icon ?? '📚' }}</td>
                        <td>
                            <strong style="color: #0048a8;">{{ $item->nama_kategori }}</strong>
                            @if($item->deskripsi)
                                <div style="font-size: 0.8rem; color: #64748b; margin-top: 2px;">{{ $item->deskripsi }}</div>
                            @endif
                        </td>
                        <td><code>{{ $item->slug }}</code></td>
                        <td>
                            <span class="badge-count">{{ $item->buku_count ?? 0 }} Buku</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.kategori.edit', $item->id) }}" class="btn-action btn-edit" title="Edit Kategori">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>

                                <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" class="form-delete-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori \'{{ addslashes($item->nama_kategori) }}\'?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus Kategori">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="empty-table-state">
                                <p>Belum ada kategori yang terdaftar.</p>
                                <a href="{{ route('admin.kategori.create') }}" class="btn-primary" style="margin-top: 10px;">
                                    + Tambah Kategori
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    @if ($kategori->hasPages())
        <div style="padding: 1.25rem 1.5rem; display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #f1f5f9; flex-wrap: wrap; gap: 1rem;">
            <div style="font-size: 0.88rem; color: #64748b;">
                Menampilkan <strong>{{ $kategori->firstItem() ?? 0 }} - {{ $kategori->lastItem() ?? 0 }}</strong> dari <strong>{{ $kategori->total() }}</strong> kategori
            </div>

            <div style="display: flex; gap: 6px;">
                @if ($kategori->onFirstPage())
                    <span style="padding: 6px 12px; background: #f1f5f9; color: #94a3b8; border-radius: 6px; font-size: 0.85rem; cursor: not-allowed;">&laquo; Sebelumnya</span>
                @else
                    <a href="{{ $kategori->previousPageUrl() }}" style="padding: 6px 12px; background: #ebf4ff; color: #0048a8; border-radius: 6px; font-size: 0.85rem; font-weight: 700; text-decoration: none;">&laquo; Sebelumnya</a>
                @endif

                @foreach ($kategori->getUrlRange(1, $kategori->lastPage()) as $page => $url)
                    @if ($page == $kategori->currentPage())
                        <span style="padding: 6px 12px; background: #0048a8; color: white; border-radius: 6px; font-size: 0.85rem; font-weight: 700;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding: 6px 12px; background: #f8fafc; color: #334155; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.85rem; text-decoration: none;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($kategori->hasMorePages())
                    <a href="{{ $kategori->nextPageUrl() }}" style="padding: 6px 12px; background: #ebf4ff; color: #0048a8; border-radius: 6px; font-size: 0.85rem; font-weight: 700; text-decoration: none;">Berikutnya &raquo;</a>
                @else
                    <span style="padding: 6px 12px; background: #f1f5f9; color: #94a3b8; border-radius: 6px; font-size: 0.85rem; cursor: not-allowed;">Berikutnya &raquo;</span>
                @endif
            </div>
        </div>
    @endif

</div>

@endsection