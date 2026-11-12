<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Katalog;
use App\Models\Kategori;
use App\Models\Aktivitas;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin User
        if (User::where('email', 'admin@perpusda.purwakarta.go.id')->doesntExist() && User::count() === 0) {
            User::create([
                'name' => 'Administrator Perpusda',
                'email' => 'admin@perpusda.purwakarta.go.id',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]);
        }

        // 2. Kategori Default
        $kategoriList = [
            ['nama' => 'Pendidikan', 'icon' => '📚', 'deskripsi' => 'Buku teks akademik, ilmu pengetahuan, dan kurikulum pembelajaran.'],
            ['nama' => 'Novel', 'icon' => '📖', 'deskripsi' => 'Karya sastra naratif fiksi, petualangan, dan cerita inspiratif.'],
            ['nama' => 'Fiksi', 'icon' => '✨', 'deskripsi' => 'Koleksi fiksi remaja, fantasi, dan dongeng nusantara.'],
            ['nama' => 'Agama', 'icon' => '🕌', 'deskripsi' => 'Buku keagamaan, akhlak, sejarah islam, dan spiritualitas.'],
            ['nama' => 'Sejarah', 'icon' => '🏛️', 'deskripsi' => 'Sejarah peradaban dunia, kemerdekaan RI, dan kearifan Purwakarta.'],
            ['nama' => 'Sains', 'icon' => '🔬', 'deskripsi' => 'Fisika, biologi, kimia, eksplorasi antariksa, dan ensiklopedia alam.'],
            ['nama' => 'Teknologi', 'icon' => '💻', 'deskripsi' => 'Komputer, pemrograman, kecerdasan buatan, dan inovasi digital.'],
            ['nama' => 'Biografi', 'icon' => '👤', 'deskripsi' => 'Kisah inspiratif tokoh nasional, pemimpin bangsa, dan cendekiawan.'],
            ['nama' => 'Sastra', 'icon' => '✍️', 'deskripsi' => 'Puisi, pantun, naskah drama, dan kumpulan esai budaya.'],
            ['nama' => 'Umum', 'icon' => '🌏', 'deskripsi' => 'Buku wawasan umum, panduan keterampilan hidup, dan referensi umum.'],
        ];

        foreach ($kategoriList as $kat) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $kat['nama']],
                [
                    'slug' => Str::slug($kat['nama']),
                    'icon' => $kat['icon'],
                    'deskripsi' => $kat['deskripsi'],
                ]
            );
        }

        // 3. Katalog Buku
        if (Katalog::count() === 0) {
            $books = [
                [
                    'judul' => '3726 MDPL',
                    'penulis' => 'Nurwina Sari',
                    'penerbit' => 'Romancious',
                    'tahun' => '2024',
                    'kategori' => 'Novel',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Laskar Pelangi',
                    'penulis' => 'Andrea Hirata',
                    'penerbit' => 'Bentang Pustaka',
                    'tahun' => '2005',
                    'kategori' => 'Pendidikan',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Bumi',
                    'penulis' => 'Tere Liye',
                    'penerbit' => 'Gramedia Pustaka Utama',
                    'tahun' => '2014',
                    'kategori' => 'Novel',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Filosofi Teras',
                    'penulis' => 'Henry Manampiring',
                    'penerbit' => 'Kompas',
                    'tahun' => '2018',
                    'kategori' => 'Sejarah',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Atomic Habits',
                    'penulis' => 'James Clear',
                    'penerbit' => 'Gramedia Pustaka Utama',
                    'tahun' => '2019',
                    'kategori' => 'Umum',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Sebuah Seni untuk Bersikap Bodo Amat',
                    'penulis' => 'Mark Manson',
                    'penerbit' => 'Grasindo',
                    'tahun' => '2018',
                    'kategori' => 'Umum',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Pulang - Pergi',
                    'penulis' => 'Tere Liye',
                    'penerbit' => 'Sabak Grip',
                    'tahun' => '2021',
                    'kategori' => 'Novel',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Sejarah Purwakarta: Jejak Peradaban dan Budaya',
                    'penulis' => 'Tim Sejarah Purwakarta',
                    'penerbit' => 'Disarpusda Purwakarta',
                    'tahun' => '2022',
                    'kategori' => 'Sejarah',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Dasar-Dasar Pemrograman Web Modern',
                    'penulis' => 'Achmad Solichin',
                    'penerbit' => 'Informatika',
                    'tahun' => '2023',
                    'kategori' => 'Teknologi',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Sains Menjelajah Alam Semesta',
                    'penulis' => 'Bambang Ruwanto',
                    'penerbit' => 'Yudhistira',
                    'tahun' => '2020',
                    'kategori' => 'Sains',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Biografi B.J. Habibie: Sang Guru Bangsa',
                    'penulis' => 'A. Makmur Makka',
                    'penerbit' => 'Republika Penerbit',
                    'tahun' => '2020',
                    'kategori' => 'Biografi',
                    'gambar' => null,
                ],
                [
                    'judul' => 'Menyelami Makna Ibadah dan Spiritualitas',
                    'penulis' => 'Prof. Dr. M. Quraish Shihab',
                    'penerbit' => 'Lentera Hati',
                    'tahun' => '2021',
                    'kategori' => 'Agama',
                    'gambar' => null,
                ],
            ];

            foreach ($books as $b) {
                Katalog::create($b);
            }
        }

        // 4. Aktivitas Awal
        if (Aktivitas::count() === 0) {
            Aktivitas::create([
                'judul' => 'Admin menambahkan koleksi buku baru: 3726 MDPL',
                'deskripsi' => 'Buku kategori Novel karya Nurwina Sari berhasil ditambahkan ke katalog',
                'tipe' => 'katalog',
                'icon' => 'plus',
                'created_at' => now()->subHours(2),
            ]);

            Aktivitas::create([
                'judul' => 'Pembaruan data katalog buku Perpusda Purwakarta',
                'deskripsi' => 'Sinkronisasi kategori buku dan penambahan koleksi literasi',
                'tipe' => 'katalog',
                'icon' => 'edit',
                'created_at' => now()->subHours(4),
            ]);

            Aktivitas::create([
                'judul' => 'Admin menambahkan buku baru: Sejarah Purwakarta',
                'deskripsi' => 'Buku muatan lokal Sejarah Purwakarta berhasil ditambahkan',
                'tipe' => 'katalog',
                'icon' => 'plus',
                'created_at' => now()->subDay(),
            ]);

            Aktivitas::create([
                'judul' => 'Sistem Informasi Perpusda Purwakarta aktif',
                'deskripsi' => 'Inisialisasi sistem perpustakaan dan basis data berhasil',
                'tipe' => 'system',
                'icon' => 'check',
                'created_at' => now()->subDays(2),
            ]);
        }
    }
}
