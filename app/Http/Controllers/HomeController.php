<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = [
            [
                'title' => 'Alat Kesehatan & Laboratorium',
                'description' => 'Peralatan medis dan laboratorium berkualitas tinggi untuk rumah sakit dan klinik',
                'icon' => 'fas fa-microscope',
                'link' => route('products.category', 'alat-kesehatan-laboratorium')
            ],
            [
                'title' => 'Produk Konsumabel',
                'description' => 'Produk habis pakai untuk kebutuhan medis dan laboratorium',
                'icon' => 'fas fa-vial',
                'link' => route('products.category', 'produk-konsumabel')
            ],
            [
                'title' => 'Linen & Apparel RS',
                'description' => 'Tekstil dan pakaian medis untuk rumah sakit',
                'icon' => 'fas fa-tshirt',
                'link' => route('products.category', 'linen-apparel-rs')
            ],
            [
                'title' => 'Jasa Konsultan & Maintenance',
                'description' => 'Layanan konsultasi dan pemeliharaan peralatan medis',
                'icon' => 'fas fa-tools',
                'link' => route('products.category', 'jasa-konsultan-maintenance')
            ]
        ];

        $testimonials = [
            [
                'name' => 'Dr. Ahmad Wijaya',
                'position' => 'Direktur RS Husada',
                'content' => 'MSA telah menjadi partner terpercaya kami dalam pengadaan alat kesehatan. Kualitas produk dan layanan yang sangat memuaskan.',
                'rating' => 5
            ],
            [
                'name' => 'Prof. Dr. Siti Nurhaliza',
                'position' => 'Kepala Lab Patologi RSUD',
                'content' => 'Alat laboratorium dari MSA sangat akurat dan handal. Tim support yang responsif dan profesional.',
                'rating' => 5
            ],
            [
                'name' => 'Ir. Bambang Sutrisno',
                'position' => 'Manager Pengadaan RS Permata',
                'content' => 'Proses pengadaan yang mudah dan transparan. MSA selalu memberikan solusi terbaik sesuai kebutuhan.',
                'rating' => 5
            ]
        ];

        return view('home', compact('services', 'testimonials'));
    }
}
