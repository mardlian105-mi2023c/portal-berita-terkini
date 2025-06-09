<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {

        $user = User::first(); 
        $categories = Category::all();

        if (!$user || $categories->count() == 0) {
            $this->command->warn('User atau kategori belum tersedia. Jalankan UserSeeder dan CategorySeeder terlebih dahulu.');
            return;
        }

        $newsData = [
            [
                'title' => 'Festival Panji Digelar Meriah di Kota Kediri',
                'content' => 'Pemerintah Kota Kediri menggelar Festival Panji dengan berbagai pertunjukan budaya yang memikat wisatawan lokal maupun mancanegara.',
                'category' => 'Budaya',
                'image' => 'festival-panji.jpg',
            ],
            [
                'title' => 'Pembangunan Jalan Lingkar Kabupaten Kediri Dimulai',
                'content' => 'Proyek jalan lingkar Kabupaten Kediri resmi dimulai untuk mengurai kemacetan di jalur utama antar kecamatan.',
                'category' => 'Pembangunan',
                'image' => 'jalan-lingkar.jpg',
            ],
            [
                'title' => 'Wisata Gunung Kelud Kembali Dibuka',
                'content' => 'Setelah sempat ditutup karena peningkatan aktivitas vulkanik, wisata Gunung Kelud di Kabupaten Kediri kini kembali dibuka dengan protokol ketat.',
                'category' => 'Wisata',
                'image' => 'gunung-kelud.jpg',
            ],
            [
                'title' => 'Pemkot Kediri Luncurkan Program UMKM Naik Kelas',
                'content' => 'Wali Kota Kediri meresmikan program pelatihan dan digitalisasi UMKM agar bisa bersaing di pasar nasional.',
                'category' => 'Ekonomi',
                'image' => 'umkm-kediri.jpg',
            ],
            [
                'title' => 'Festival Kopi Kediri Tarik Minat Penikmat Kopi',
                'content' => 'Festival Kopi yang diselenggarakan di Alun-Alun Kediri menampilkan berbagai produk unggulan petani kopi lokal.',
                'category' => 'Kuliner',
                'image' => 'festival-kopi.jpg',
            ],
            [
                'title' => 'Pemkab Kediri Bangun Pasar Modern di Pare',
                'content' => 'Pasar modern pertama di Kecamatan Pare dibangun untuk meningkatkan fasilitas perdagangan tradisional.',
                'category' => 'Pembangunan',
                'image' => 'pasar-pare.jpg',
            ],
            [
                'title' => 'Pelajar Kediri Raih Juara Olimpiade Sains Nasional',
                'content' => 'Siswa SMA di Kota Kediri berhasil meraih medali emas dalam Olimpiade Sains Nasional bidang Kimia.',
                'category' => 'Pendidikan',
                'image' => 'osn-kediri.jpg',
            ],
            [
                'title' => 'Kediri Gelar Lomba Dayung di Sungai Brantas',
                'content' => 'Sebagai bagian dari peringatan HUT Kota Kediri, lomba dayung diselenggarakan dengan antusiasme tinggi dari masyarakat.',
                'category' => 'Olahraga',
                'image' => 'dayung-brantas.jpg',
            ],
            [
                'title' => 'Panen Raya Padi di Kabupaten Kediri',
                'content' => 'Petani di beberapa kecamatan merayakan panen raya padi dengan hasil yang meningkat dibanding tahun sebelumnya.',
                'category' => 'Pertanian',
                'image' => 'panen-padi.jpg',
            ],
            [
                'title' => 'Pemkot Kediri Terapkan Sistem Parkir Digital',
                'content' => 'Dinas Perhubungan Kota Kediri mulai menerapkan sistem parkir digital untuk mengurangi pungli dan meningkatkan pendapatan daerah.',
                'category' => 'Teknologi',
                'image' => 'parkir-digital.jpg',
            ],
            [
                'title' => 'Seni Reog Ponorogo Ditampilkan di Alun-Alun Kediri',
                'content' => 'Pertunjukan Reog Ponorogo diadakan sebagai bagian dari promosi budaya Jawa Timur di Kota Kediri.',
                'category' => 'Budaya',
                'image' => 'reog-kediri.jpg',
            ],
            [
                'title' => 'Pemkab Kediri Adakan Pelatihan Peternak Sapi Perah',
                'content' => 'Dinas Peternakan Kabupaten Kediri memberikan pelatihan kepada peternak sapi perah untuk meningkatkan produksi susu.',
                'category' => 'Pertanian',
                'image' => 'sapi-perah.jpg',
            ],
            [
                'title' => 'Program Bedah Rumah untuk Warga Miskin di Kabupaten Kediri',
                'content' => 'Puluhan rumah warga yang tidak layak huni mendapatkan bantuan renovasi melalui program bedah rumah.',
                'category' => 'Sosial',
                'image' => 'bedah-rumah.jpg',
            ],
            [
                'title' => 'Kota Kediri Tuan Rumah Festival Film Pendek Remaja',
                'content' => 'Festival film pendek remaja tingkat Jawa Timur diselenggarakan di Kediri dengan tema pendidikan dan budaya.',
                'category' => 'Pendidikan',
                'image' => 'film-pendek.jpg',
            ],
            [
                'title' => 'Ribuan Jamaah Hadiri Pengajian Akbar di Simpang Lima Gumul',
                'content' => 'Pengajian akbar digelar di kawasan Simpang Lima Gumul dengan penceramah nasional dan pengunjung dari berbagai daerah.',
                'category' => 'Religi',
                'image' => 'pengajian-gumul.jpg',
            ],
        ];
        

        foreach ($newsData as $newsItem) {
            // Mengambil kategori yang sesuai berdasarkan nama kategori
            $category = Category::where('name', $newsItem['category'])->first();
            
            if ($category) {
                News::create([
                    'title' => $newsItem['title'],
                    'content' => $newsItem['content'],
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'image' => $newsItem['image'],
                ]);
            }
        }

        $this->command->info('NewsSeeder telah selesai.');
    }
}