<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        Post::create([
            'category_id' => 1, // Politik
            'title' => 'Pemerintah Resmikan Proyek Ibu Kota Nusantara Tahap Pertama',
            'slug' => Str::slug('Pemerintah Resmikan Proyek Ibu Kota Nusantara Tahap Pertama'),
            'content' => 'Presiden Joko Widodo meresmikan sejumlah infrastruktur dasar di Ibu Kota Nusantara (IKN) sebagai penanda dimulainya pembangunan tahap pertama. Proyek ini diharapkan dapat mendorong pemerataan ekonomi di luar Jawa.',
            'published_at' => now()
        ]);

        Post::create([
            'category_id' => 3, // Olahraga
            'title' => 'Timnas Indonesia Lolos ke Putaran Final Piala Asia 2027',
            'slug' => Str::slug('Timnas Indonesia Lolos ke Putaran Final Piala Asia 2027'),
            'content' => 'Timnas Sepak Bola Indonesia berhasil memastikan satu tempat di putaran final Piala Asia 2027 setelah mengalahkan rivalnya, Malaysia, dengan skor tipis 2-1 di pertandingan kualifikasi terakhir.',
            'published_at' => now()
        ]);

         Post::create([
            'category_id' => 2, // Ekonomi
            'title' => 'Rupiah Menguat Tipis Terhadap Dolar di Awal Pekan',
            'slug' => Str::slug('Rupiah Menguat Tipis Terhadap Dolar di Awal Pekan'),
            'content' => 'Nilai tukar rupiah dibuka menguat tipis sebesar 0,2% terhadap dolar AS pada perdagangan Senin pagi. Penguatan ini didorong oleh sentimen positif dari data inflasi domestik yang terkendali.',
            'published_at' => now()
        ]);

        Post::create([
            'category_id' => 4, // Teknologi
            'title' => 'Startup Lokal Rilis Aplikasi Edukasi Berbasis AI',
            'slug' => Str::slug('Startup Lokal Rilis Aplikasi Edukasi Berbasis AI'),
            'content' => 'Sebuah startup teknologi asal Surabaya meluncurkan aplikasi pendidikan yang memanfaatkan kecerdasan buatan (AI) untuk membantu siswa belajar matematika. Aplikasi ini diklaim dapat menyesuaikan materi dengan kemampuan masing-masing siswa.',
            'published_at' => now()
        ]);
    }
}