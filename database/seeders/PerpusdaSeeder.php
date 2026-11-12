<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use Illuminate\Support\Facades\Hash; use App\Models\{User,Profil,KategoriBuku,KatalogBuku,Layanan,Fasilitas,Organigram,Berita};
class PerpusdaSeeder extends Seeder { public function run():void{
 User::firstOrCreate(['username'=>'admin'],['email'=>'admin@perpusda.id','password'=>Hash::make('admin123')]);
 Profil::firstOrCreate(['id'=>1],['judul'=>'Profil Perpustakaan Daerah Purwakarta','isi'=>'Perpustakaan Daerah Kabupaten Purwakarta merupakan layanan informasi dan literasi bagi masyarakat.']);
 foreach(['Novel','Pendidikan','Sejarah','Biografi'] as $n)KategoriBuku::firstOrCreate(['nama_kategori'=>$n]);
 $novel=KategoriBuku::where('nama_kategori','Novel')->value('id_kategori');$pend=KategoriBuku::where('nama_kategori','Pendidikan')->value('id_kategori');
 KatalogBuku::firstOrCreate(['judul_buku'=>'3726 MDPL'],['penulis'=>'Nurwina Sari','penerbit'=>'Romancious','tahun_terbit'=>2024,'id_kategori'=>$novel]);
 KatalogBuku::firstOrCreate(['judul_buku'=>'Laskar Pelangi'],['penulis'=>'Andrea Hirata','penerbit'=>'Bentang Pustaka','tahun_terbit'=>2005,'id_kategori'=>$pend]);
 foreach([['Pembuatan kartu anggota','Layanan pembuatan kartu anggota perpustakaan.'],['Perpustakaan Keliling','Layanan perpustakaan keliling untuk menjangkau masyarakat.'],['Layanan Baca di Tempat','Layanan membaca koleksi buku di ruang perpustakaan.'],['Layanan Literasi','Layanan dan kegiatan literasi perpustakaan.']] as $x)Layanan::firstOrCreate(['nama_layanan'=>$x[0]],['deskripsi'=>$x[1]]);
 foreach(['Ruang lobby','Ruang anak','Ruang remaja','Ruang dewasa'] as $n)Fasilitas::firstOrCreate(['nama_fasilitas'=>$n],['deskripsi'=>'Informasi fasilitas '.$n.'.']);
 foreach([['Falah','Kepala Perpustakaan'],['Bilqis','Sekretaris'],['Nury','Staf Administrasi'],['Asadel','Staf Layanan']] as $x)Organigram::firstOrCreate($x);
 Berita::firstOrCreate(['judul'=>'Informasi Perpusda Purwakarta'],['link'=>'https://disipusda.purwakartakab.go.id/','tanggal'=>now()->toDateString()]);
} }
