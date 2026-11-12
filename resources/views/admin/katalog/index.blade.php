@extends('admin.layouts.app')

@section('title', 'Katalog Buku')

@section('content')

<div class="page-title">
    <div>
        <h1>Katalog Buku</h1>
        <p>Kelola koleksi dan informasi buku Perpustakaan Daerah Purwakarta</p>
    </div>

    <div class="page-title-actions">
        <a href="{{ route('admin.katalog.create') }}" class="btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Tambah Buku Baru</span>
        </a>
    </div>
</div>

<div class="table-card">

    <div class="table-card-header" style="flex-wrap: wrap; gap: 1rem;">
        <div class="table-card-title">
            <h3>Daftar Koleksi Buku</h3>
            <span class="badge-count">{{ $buku->total() }} Judul Buku</span>
        </div>

        <!-- SERVER-SIDE FILTER & SEARCH -->
        <form action="{{ route('admin.katalog') }}" method="GET" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <!-- Filter Kategori -->
            <select name="kategori" onchange="this.form.submit()" style="padding: 8px 12px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.88rem; background: white; color: #334155;">
                <option value="">-- Semua Kategori --</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>

            <div class="table-search-box" style="margin: 0;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul, penulis, penerbit...">
            </div>

            <button type="submit" class="btn-primary" style="padding: 8px 14px; font-size: 0.88rem;">Cari</button>

            @if(request('q') || request('kategori'))
                <a href="{{ route('admin.katalog') }}" style="font-size: 0.85rem; color: #ef4444; font-weight: 700; text-decoration: none; padding: 6px 10px; background: #fee2e2; border-radius: 6px;">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-container">

        <table class="admin-table katalog-table" id="katalogTable">

            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 90px;">Sampul</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th style="width: 80px;">Tahun</th>
                    <th>Kategori</th>
                    <th style="width: 110px; text-align: center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($buku as $index => $item)
                    <tr>
                        <td class="text-center font-medium">{{ ($buku->currentPage() - 1) * $buku->perPage() + $index + 1 }}</td>
                        <td>
                            <div class="buku-cover-wrapper">
                                @if ($item->gambar && file_exists(public_path('uploads/katalog/' . $item->gambar)))
                                    <img src="{{ asset('uploads/katalog/' . $item->gambar) }}" alt="{{ $item->judul }}" class="buku-cover-img" loading="lazy">
                                @else
                                    <div class="buku-cover-placeholder">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                        <span>No Cover</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <strong class="buku-title-text">{{ $item->judul }}</strong>
                        </td>
                        <td>{{ $item->penulis }}</td>
                        <td>{{ $item->penerbit }}</td>
                        <td class="font-medium">{{ $item->tahun }}</td>
                        <td>
                            <span class="badge-kategori">{{ $item->kategori }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.katalog.edit', $item->id) }}" class="btn-action btn-edit" title="Edit Buku">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>

                                <form action="{{ route('admin.katalog.destroy', $item->id) }}" method="POST" class="form-delete-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ addslashes($item->judul) }}\'?');">
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
                        <td colspan="8" class="text-center py-5">
                            <div class="empty-table-state">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                <p>Belum ada koleksi buku yang cocok.</p>
                                <a href="{{ route('admin.katalog.create') }}" class="btn-primary" style="margin-top: 10px;">
                                    + Tambah Buku Sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    <!-- BACKEND PAGINATION LINKS -->
    @if ($buku->hasPages())
        <div class="table-pagination-footer" style="padding: 1.25rem 1.5rem; display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #f1f5f9; flex-wrap: wrap; gap: 1rem;">
            <div style="font-size: 0.88rem; color: #64748b;">
                Menampilkan <strong>{{ $buku->firstItem() ?? 0 }} - {{ $buku->lastItem() ?? 0 }}</strong> dari <strong>{{ $buku->total() }}</strong> buku
            </div>

            <div style="display: flex; gap: 6px;">
                @if ($buku->onFirstPage())
                    <span style="padding: 6px 12px; background: #f1f5f9; color: #94a3b8; border-radius: 6px; font-size: 0.85rem; cursor: not-allowed;">&laquo; Sebelumnya</span>
                @else
                    <a href="{{ $buku->previousPageUrl() }}" style="padding: 6px 12px; background: #ebf4ff; color: #0048a8; border-radius: 6px; font-size: 0.85rem; font-weight: 700; text-decoration: none;">&laquo; Sebelumnya</a>
                @endif

                @foreach ($buku->getUrlRange(1, $buku->lastPage()) as $page => $url)
                    @if ($page == $buku->currentPage())
                        <span style="padding: 6px 12px; background: #0048a8; color: white; border-radius: 6px; font-size: 0.85rem; font-weight: 700;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding: 6px 12px; background: #f8fafc; color: #334155; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.85rem; text-decoration: none;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($buku->hasMorePages())
                    <a href="{{ $buku->nextPageUrl() }}" style="padding: 6px 12px; background: #ebf4ff; color: #0048a8; border-radius: 6px; font-size: 0.85rem; font-weight: 700; text-decoration: none;">Berikutnya &raquo;</a>
                @else
                    <span style="padding: 6px 12px; background: #f1f5f9; color: #94a3b8; border-radius: 6px; font-size: 0.85rem; cursor: not-allowed;">Berikutnya &raquo;</span>
                @endif
            </div>
        </div>
    @endif

</div>

@endsection