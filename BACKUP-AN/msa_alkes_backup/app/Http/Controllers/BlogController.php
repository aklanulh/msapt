<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $articles = [
            [
                'id' => 1,
                'title' => 'Panduan Memilih Monitor Pasien yang Tepat untuk ICU',
                'slug' => 'panduan-memilih-monitor-pasien-icu',
                'excerpt' => 'Tips penting dalam memilih monitor pasien multiparameter untuk unit perawatan intensif',
                'image' => '/images/blog/article-1.jpg',
                'author' => 'Dr. Ahmad Wijaya',
                'date' => '2024-01-15',
                'category' => 'Alat Kesehatan',
                'read_time' => '5 menit'
            ],
            [
                'id' => 2,
                'title' => 'Teknologi Terbaru dalam Hematology Analyzer',
                'slug' => 'teknologi-terbaru-hematology-analyzer',
                'excerpt' => 'Perkembangan teknologi analisis darah otomatis untuk laboratorium modern',
                'image' => '/images/blog/article-2.jpg',
                'author' => 'Prof. Dr. Siti Nurhaliza',
                'date' => '2024-01-10',
                'category' => 'Alat Laboratorium',
                'read_time' => '7 menit'
            ],
            [
                'id' => 3,
                'title' => 'Standar Kalibrasi Alat Medis Sesuai Regulasi',
                'slug' => 'standar-kalibrasi-alat-medis-regulasi',
                'excerpt' => 'Pentingnya kalibrasi berkala untuk menjaga akurasi dan keamanan alat medis',
                'image' => '/images/blog/article-3.jpg',
                'author' => 'Ir. Bambang Sutrisno',
                'date' => '2024-01-05',
                'category' => 'Regulasi',
                'read_time' => '6 menit'
            ]
        ];

        return view('blog.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = $this->getArticleBySlug($slug);
        $relatedArticles = $this->getRelatedArticles($article['category'], $article['id']);
        
        return view('blog.show', compact('article', 'relatedArticles'));
    }

    private function getArticleBySlug($slug)
    {
        // Sample article data
        return [
            'id' => 1,
            'title' => 'Panduan Memilih Monitor Pasien yang Tepat untuk ICU',
            'slug' => 'panduan-memilih-monitor-pasien-icu',
            'content' => '<p>Monitor pasien merupakan salah satu peralatan vital dalam unit perawatan intensif (ICU). Pemilihan monitor yang tepat sangat penting untuk memastikan monitoring yang akurat dan kontinyu terhadap kondisi pasien kritis.</p>

<h3>Faktor-faktor Penting dalam Pemilihan</h3>
<p>Beberapa faktor yang perlu dipertimbangkan dalam memilih monitor pasien untuk ICU:</p>
<ul>
<li><strong>Parameter Monitoring:</strong> Pastikan monitor dapat mengukur semua parameter vital yang dibutuhkan seperti ECG, SpO2, NIBP, dan suhu.</li>
<li><strong>Akurasi dan Reliabilitas:</strong> Pilih monitor dengan tingkat akurasi tinggi dan sistem alarm yang handal.</li>
<li><strong>Kemudahan Penggunaan:</strong> Interface yang user-friendly akan memudahkan tenaga medis dalam operasional.</li>
<li><strong>Konektivitas:</strong> Kemampuan integrasi dengan sistem informasi rumah sakit (HIS).</li>
</ul>

<h3>Rekomendasi Brand Terpercaya</h3>
<p>Beberapa brand monitor pasien yang telah terbukti kualitasnya di lingkungan ICU antara lain Philips, GE Healthcare, dan Mindray. Setiap brand memiliki keunggulan masing-masing yang dapat disesuaikan dengan kebutuhan dan budget rumah sakit.</p>',
            'image' => '/images/blog/article-1.jpg',
            'author' => 'Dr. Ahmad Wijaya',
            'date' => '2024-01-15',
            'category' => 'Alat Kesehatan',
            'read_time' => '5 menit',
            'tags' => ['Monitor Pasien', 'ICU', 'Alat Kesehatan', 'Rumah Sakit']
        ];
    }

    private function getRelatedArticles($category, $excludeId)
    {
        // Sample related articles
        return [
            [
                'id' => 2,
                'title' => 'Teknologi Terbaru dalam Hematology Analyzer',
                'slug' => 'teknologi-terbaru-hematology-analyzer',
                'image' => '/images/blog/article-2.jpg',
                'date' => '2024-01-10'
            ],
            [
                'id' => 3,
                'title' => 'Standar Kalibrasi Alat Medis Sesuai Regulasi',
                'slug' => 'standar-kalibrasi-alat-medis-regulasi',
                'image' => '/images/blog/article-3.jpg',
                'date' => '2024-01-05'
            ]
        ];
    }
}
