<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BeritaController extends Controller
{
    /**
     * Tampilkan daftar berita
     */
    public function index()
    {
        $berita = Berita::orderBy('tanggal', 'desc')->get();

        return view('admin.berita.index', compact('berita'));
    }

    /**
     * Form tambah berita baru
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Ambil metadata berita dari URL untuk preview
     */
    public function preview(Request $request)
    {
        $request->validate([
            'link' => 'required|url|max:2000',
        ], [
            'link.required' => 'Link berita wajib diisi.',
            'link.url' => 'Format link berita tidak valid.',
        ]);

        $url = $request->input('link');
        $parts = parse_url($url);

        if (
            !$parts ||
            !in_array(strtolower($parts['scheme'] ?? ''), ['http', 'https']) ||
            empty($parts['host']) ||
            isset($parts['user']) ||
            isset($parts['pass'])
        ) {
            return response()->json([
                'message' => 'URL tidak valid atau tidak diizinkan.',
            ], 422);
        }

        $host = strtolower($parts['host']);
        $port = $parts['port'] ?? null;

        if (
            ($port && !in_array($port, [80, 443])) ||
            ($port === 80 && strtolower($parts['scheme']) !== 'http') ||
            ($port === 443 && strtolower($parts['scheme']) !== 'https')
        ) {
            return response()->json([
                'message' => 'Port URL tidak diizinkan.',
            ], 422);
        }

        if (
            $host === 'localhost' ||
            str_ends_with($host, '.localhost') ||
            str_ends_with($host, '.local') ||
            str_ends_with($host, '.internal')
        ) {
            return response()->json([
                'message' => 'Alamat lokal tidak diizinkan.',
            ], 422);
        }

        // Periksa alamat IP atau DNS
        $addresses = [];

        if (filter_var($host, FILTER_VALIDATE_IP)) {
            $addresses[] = $host;
        } else {
            $addresses = gethostbynamel($host) ?: [];

            $ipv6Records = @dns_get_record($host, DNS_AAAA) ?: [];

            foreach ($ipv6Records as $record) {
                if (!empty($record['ipv6'])) {
                    $addresses[] = $record['ipv6'];
                }
            }
        }

        if (empty($addresses)) {
            return response()->json([
                'message' => 'Alamat website tidak dapat ditemukan.',
            ], 422);
        }

        foreach ($addresses as $address) {
            if (!filter_var(
                $address,
                FILTER_VALIDATE_IP,
                FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
            )) {
                return response()->json([
                    'message' => 'Alamat website tidak diizinkan.',
                ], 422);
            }
        }

        try {
            $response = Http::withOptions([
                'allow_redirects' => false,
                'verify' => true,
            ])
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (compatible; PerpusdaBot/1.0)',
                    'Accept' => 'text/html,application/xhtml+xml',
                ])
                ->timeout(15)
                ->get($url);

            if (!$response->successful()) {
                return response()->json([
                    'message' => 'Website tidak bisa diakses atau menolak permintaan.',
                ], 422);
            }

            $contentType = $response->header('Content-Type', '');

            if (!str_contains(strtolower($contentType), 'text/html')) {
                return response()->json([
                    'message' => 'Link tersebut bukan halaman berita berbentuk HTML.',
                ], 422);
            }

            $html = $response->body();

            if (strlen($html) > 3 * 1024 * 1024) {
                return response()->json([
                    'message' => 'Ukuran halaman terlalu besar untuk diproses.',
                ], 422);
            }

            // Baca HTML halaman
            libxml_use_internal_errors(true);

            $dom = new \DOMDocument();
            $dom->loadHTML('<?xml encoding="UTF-8">' . $html);

            $xpath = new \DOMXPath($dom);

            // Fungsi untuk membaca metadata
            $getMeta = function ($selectors) use ($xpath) {
                foreach ($selectors as $selector) {
                    $nodes = $xpath->query($selector);

                    if ($nodes && $nodes->length > 0) {
                        $value = trim(
                            $nodes->item(0)->getAttribute('content')
                        );

                        if ($value !== '') {
                            return $value;
                        }
                    }
                }

                return null;
            };

            // Ambil judul
            $judul = $getMeta([
                '//meta[@property="og:title"]',
                '//meta[@name="twitter:title"]',
            ]);

            if (!$judul) {
                $titleNode = $xpath->query('//title');

                $judul = $titleNode && $titleNode->length
                    ? trim($titleNode->item(0)->textContent)
                    : null;
            }

            // Ambil deskripsi
            $deskripsi = $getMeta([
                '//meta[@property="og:description"]',
                '//meta[@name="twitter:description"]',
                '//meta[@name="description"]',
            ]);

            // Ambil gambar
            $gambar = $getMeta([
                '//meta[@property="og:image"]',
                '//meta[@name="twitter:image"]',
            ]);

            // Ambil tanggal publikasi
            $tanggal = $getMeta([
                '//meta[@property="article:published_time"]',
                '//meta[@name="article:published_time"]',
                '//meta[@property="og:published_time"]',
                '//meta[@itemprop="datePublished"]',
                '//meta[@name="datePublished"]',
                '//meta[@name="pubdate"]',
            ]);

            if (!$tanggal) {
                $timeNode = $xpath->query('//time[@datetime]');

                if ($timeNode && $timeNode->length > 0) {
                    $tanggal = $timeNode->item(0)->getAttribute('datetime');
                }
            }

            // Ubah URL gambar relatif menjadi URL lengkap
            if ($gambar) {
                if (str_starts_with($gambar, '//')) {
                    $gambar = $parts['scheme'] . ':' . $gambar;
                } elseif (str_starts_with($gambar, '/')) {
                    $gambar = $parts['scheme'] . '://' . $parts['host']
                        . (isset($parts['port']) ? ':' . $parts['port'] : '')
                        . $gambar;
                } elseif (!preg_match('/^https?:\/\//i', $gambar)) {
                    $basePath = $parts['path'] ?? '/';
                    $baseDirectory = rtrim(dirname($basePath), '/');

                    $gambar = $parts['scheme'] . '://' . $parts['host']
                        . $baseDirectory . '/' . $gambar;
                }
            }

            // Format tanggal
            try {
                $tanggal = $tanggal
                    ? \Carbon\Carbon::parse($tanggal)->format('Y-m-d')
                    : null;
            } catch (\Throwable $e) {
                $tanggal = null;
            }

            libxml_clear_errors();

            if (!$judul && !$deskripsi && !$gambar) {
                return response()->json([
                    'message' => 'Metadata berita tidak ditemukan. Silakan isi data secara manual.',
                ], 422);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'judul' => $judul,
                    'deskripsi' => $deskripsi,
                    'tanggal' => $tanggal,
                    'gambar' => $gambar,
                    'link' => $url,
                ],
            ]);

        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'message' => 'Gagal mengambil metadata. Periksa link atau coba website lain.',
            ], 422);
        }
    }

    /**
     * Simpan berita baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'required|url|max:2000',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|string|max:2000',
            'gambar_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'link.required' => 'Link berita wajib diisi.',
            'link.url' => 'Format link berita tidak valid.',
            'tanggal.required' => 'Tanggal publikasi wajib diisi.',
            'gambar_file.image' => 'Berkas harus berupa gambar (JPG, JPEG, PNG, WebP).',
            'gambar_file.max' => 'Ukuran gambar maksimal 3MB.',
        ]);

        $gambarPath = null;

        if ($request->hasFile('gambar_file')) {
            $gambarPath = $request->file('gambar_file')->store('berita', 'public');
        } elseif ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        } elseif (!empty($validated['gambar'])) {
            try {
                $gambarPath = $this->downloadImage($validated['gambar']);
            } catch (\Throwable $e) {
                report($e);

                throw ValidationException::withMessages([
                    'gambar' => 'Gambar gagal diunduh. Silakan ambil preview ulang, unggah manual, atau coba link berita lain.',
                ]);
            }
        }

        $berita = Berita::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'link' => $validated['link'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $gambarPath,
        ]);

        try {
            Aktivitas::create([
                'judul' => 'Penambahan Berita Baru',
                'deskripsi' => 'Berita baru ditambahkan: ' . $berita->judul,
                'tipe' => 'berita',
                'icon' => 'plus',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Form edit berita
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);

        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Perbarui data berita di database
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'required|url|max:2000',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'link.required' => 'Link berita wajib diisi.',
            'link.url' => 'Format tautan link berita tidak valid.',
            'tanggal.required' => 'Tanggal publikasi berita wajib diisi.',
            'gambar.image' => 'Berkas harus berupa gambar (JPG, JPEG, PNG, WebP).',
            'gambar.max' => 'Ukuran gambar berita maksimal 3MB.',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'tanggal' => $request->tanggal,
        ];

        if ($request->hasFile('gambar')) {
            if (
                $berita->gambar &&
                Storage::disk('public')->exists($berita->gambar)
            ) {
                Storage::disk('public')->delete($berita->gambar);
            } elseif (
                $berita->gambar &&
                file_exists(public_path('images/' . $berita->gambar))
            ) {
                @unlink(public_path('images/' . $berita->gambar));
            }

            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        try {
            Aktivitas::create([
                'judul' => 'Pembaruan Berita',
                'deskripsi' => 'Berita diperbarui: ' . $berita->judul,
                'tipe' => 'berita',
                'icon' => 'edit',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita dari database
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if (
            $berita->gambar &&
            Storage::disk('public')->exists($berita->gambar)
        ) {
            Storage::disk('public')->delete($berita->gambar);
        } elseif (
            $berita->gambar &&
            file_exists(public_path('images/' . $berita->gambar))
        ) {
            @unlink(public_path('images/' . $berita->gambar));
        }

        $judul = $berita->judul;
        $berita->delete();

        try {
            Aktivitas::create([
                'judul' => 'Penghapusan Berita',
                'deskripsi' => 'Berita dihapus: ' . $judul,
                'tipe' => 'berita',
                'icon' => 'trash',
            ]);
        } catch (\Throwable $e) {}

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Unduh gambar dari URL dan simpan ke storage publik
     */
    private function downloadImage(string $url): string
    {
        $parts = parse_url($url);

        if (
            !$parts ||
            !in_array(strtolower($parts['scheme'] ?? ''), ['http', 'https']) ||
            empty($parts['host']) ||
            isset($parts['user']) ||
            isset($parts['pass'])
        ) {
            throw new \Exception('URL gambar tidak valid.');
        }

        $host = strtolower($parts['host']);
        $port = $parts['port'] ?? null;

        if (
            ($port && !in_array($port, [80, 443])) ||
            str_ends_with($host, '.local') ||
            str_ends_with($host, '.internal') ||
            $host === 'localhost' ||
            str_ends_with($host, '.localhost')
        ) {
            throw new \Exception('Alamat gambar tidak diizinkan.');
        }

        // Periksa alamat IP atau DNS
        $addresses = [];

        if (filter_var($host, FILTER_VALIDATE_IP)) {
            $addresses[] = $host;
        } else {
            $addresses = gethostbynamel($host) ?: [];

            $ipv6Records = @dns_get_record($host, DNS_AAAA) ?: [];

            foreach ($ipv6Records as $record) {
                if (!empty($record['ipv6'])) {
                    $addresses[] = $record['ipv6'];
                }
            }
        }

        if (empty($addresses)) {
            throw new \Exception('Alamat gambar tidak ditemukan.');
        }

        foreach ($addresses as $address) {
            if (!filter_var(
                $address,
                FILTER_VALIDATE_IP,
                FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
            )) {
                throw new \Exception('Alamat gambar tidak diizinkan.');
            }
        }

        // Unduh gambar tanpa mengikuti redirect
        $response = Http::withOptions([
            'allow_redirects' => false,
            'verify' => true,
        ])
            ->timeout(20)
            ->get($url);

        if (!$response->successful()) {
            throw new \Exception('Gambar tidak dapat diunduh.');
        }

        $mime = strtolower(trim(
            explode(';', $response->header('Content-Type', ''))[0]
        ));

        $extensions = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
        ];

        if (!isset($extensions[$mime])) {
            throw new \Exception('Format gambar harus JPG, PNG, atau WebP.');
        }

        $content = $response->body();

        if (strlen($content) > 3 * 1024 * 1024) {
            throw new \Exception('Ukuran gambar maksimal 3 MB.');
        }

        // Pastikan isi file benar-benar gambar
        $imageInfo = @getimagesizefromstring($content);

        if (!$imageInfo || $imageInfo['mime'] !== $mime) {
            throw new \Exception('File yang diunduh bukan gambar yang valid.');
        }

        $filename = 'berita/' . Str::uuid() . '.' . $extensions[$mime];

        Storage::disk('public')->put($filename, $content);

        return $filename;
    }
}
