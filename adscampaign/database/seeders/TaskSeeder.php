<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat beberapa tasks
        Task::create([
            'title' => 'Unggah Foto Produk di Instagram',
            'description' => 'Posting foto kreatif Anda bersama produk di Instagram dan tag akun resmi kami @AkunBrand. Gunakan hashtag #BrandKami untuk kesempatan memenangkan hadiah!',
            'points' => 20,
            'deadline' => Carbon::now()->addDays(30),
        ]);

        Task::create([
            'title' => 'Lomba Kreativitas Kemerdekaan',
            'description' => 'Ikuti lomba kreativitas dengan tema kemerdekaan: menggambar, membuat poster, atau menulis puisi yang mengungkapkan cinta pada Indonesia. Posting karya Anda di media sosial, tag akun Kemendikbud, dan gunakan hashtag #KreativitasKemerdekaan.',
            'points' => 15,
            'deadline' => Carbon::now()->addDays(12),
        ]);

        Task::create([
            'title' => 'Review Produk di Facebook',
            'description' => 'Bagikan pengalaman Anda menggunakan produk kami di Facebook. Mention akun kami dan gunakan hashtag #ReviewBrandKami. Setiap postingan akan mendapatkan poin tambahan.',
            'points' => 20,
            'deadline' => Carbon::now()->addDays(30),
        ]);

        Task::create([
            'title' => 'Dukung Gerakan Cinta Lingkungan',
            'description' => 'Posting foto atau video aksi peduli lingkungan, seperti menanam pohon atau membersihkan sampah di sekitar Anda. Tag akun resmi kami dan gunakan hashtag #CintaLingkungan. Setiap postingan akan memberikan poin tambahan.',
            'points' => 25,
            'deadline' => Carbon::now()->addDays(20),
        ]);

        Task::create([
            'title' => 'Ulasan Produk di Twitter',
            'description' => 'Tweet ulasan singkat tentang produk kami di Twitter dan tag akun kami @AkunBrandOfficial. Gunakan hashtag #ProdukKerenKami untuk mendapatkan poin.',
            'points' => 20,
            'deadline' => Carbon::now()->addDays(15),
        ]);
        Task::create([
            'title' => 'Bagikan Cerita Tentang Pahlawan Indonesia',
            'description' => 'Posting tentang pahlawan Indonesia yang menginspirasi di media sosial. Tuliskan kisah atau pesan yang berkesan dari perjuangan pahlawan tersebut, tag akun Kemendikbud, dan gunakan hashtag #PahlawanIndonesia. Dapatkan poin dengan setiap cerita yang diposting.',
            'points' => 30,
            'deadline' => Carbon::now()->addDays(7),
        ]);
    }
}
