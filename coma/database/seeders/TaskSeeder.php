<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Review Produk Skincare',
            'description' => 'Tulis review produk skincare terbaru dari brand lokal dengan minimal 200 kata. Review harus mencakup pengalaman penggunaan, hasil yang dirasakan, dan rekomendasi.',
            'points' => 50,
            'deadline' => '2025-08-05 23:59:59',
            'category' => 'Review',
            'requirements' => json_encode([
                'Minimal 200 kata',
                'Upload foto before/after (opsional)',
                'Mention brand di social media',
                'Tag 3 teman di komentar'
            ]),
            'status' => 'available'
        ]);

        Task::create([
            'title' => 'Share Post Instagram',
            'description' => 'Share post kampanye di Instagram story dengan mention brand dan hashtag yang telah ditentukan.',
            'points' => 30,
            'deadline' => '2025-07-29 12:00:00', // EXPIRED - kemarin
            'category' => 'Social Media',
            'requirements' => json_encode([
                'Post di Instagram Story',
                'Mention @brandname',
                'Gunakan hashtag #kampanye2025',
                'Screenshot sebagai bukti'
            ]),
            'status' => 'available'
        ]);

        Task::create([
            'title' => 'Survey Konsumen',
            'description' => 'Isi survey tentang preferensi produk makanan ringan untuk riset pasar.',
            'points' => 25,
            'deadline' => '2025-07-30 18:00:00', // DEADLINE DEKAT - hari ini sore
            'category' => 'Survey',
            'requirements' => json_encode([
                'Isi semua pertanyaan dengan lengkap',
                'Berikan jawaban yang jujur',
                'Submit dalam waktu yang ditentukan'
            ]),
            'status' => 'available'
        ]);

        Task::create([
            'title' => 'Video Testimoni Produk',
            'description' => 'Buat video testimoni penggunaan produk dengan durasi 30-60 detik.',
            'points' => 75,
            'deadline' => '2025-08-10 23:59:59',
            'category' => 'Video',
            'requirements' => json_encode([
                'Durasi 30-60 detik',
                'Kualitas video HD',
                'Suara jelas dan terdengar',
                'Tunjukkan produk dengan jelas'
            ]),
            'status' => 'available'
        ]);

        Task::create([
            'title' => 'Like dan Comment Post',
            'description' => 'Like dan berikan komentar positif pada 5 post terakhir brand di Instagram.',
            'points' => 15,
            'deadline' => '2025-07-28 23:59:59', // EXPIRED - 2 hari lalu
            'category' => 'Engagement',
            'requirements' => json_encode([
                'Like 5 post terakhir',
                'Komentar minimal 10 kata',
                'Komentar harus relevan dan positif',
                'Screenshot sebagai bukti'
            ]),
            'status' => 'available'
        ]);

        // Task tambahan untuk testing
        Task::create([
            'title' => 'Testing Task Expired',
            'description' => 'Task ini khusus untuk testing fitur expired deadline indicator.',
            'points' => 40,
            'deadline' => '2025-07-25 10:00:00', // EXPIRED - 5 hari lalu
            'category' => 'Testing',
            'requirements' => json_encode([
                'Upload screenshot',
                'Submit URL'
            ]),
            'status' => 'available'
        ]);

        Task::create([
            'title' => 'Testing Task Deadline Dekat',
            'description' => 'Task ini khusus untuk testing fitur deadline dekat indicator.',
            'points' => 35,
            'deadline' => '2025-07-30 14:00:00', // DEADLINE DEKAT - siang ini
            'category' => 'Testing',
            'requirements' => json_encode([
                'Upload foto',
                'Tulis caption'
            ]),
            'status' => 'available'
        ]);
    }
}
