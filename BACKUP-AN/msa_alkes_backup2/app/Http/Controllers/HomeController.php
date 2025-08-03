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
                'description' => 'Hematology Analyzer, Chemistry Analyzer, Urine Analyzer, Blood Gas Analyzer, Patient Monitor, Ventilator, Mobile X-Ray, C-Arm, MRI, Digital Mammography, Ultrasound',
                'icon' => 'fas fa-microscope',
                'link' => route('products.category', 'alat-kesehatan-laboratorium')
            ],
            [
                'title' => 'Produk Konsumabel',
                'description' => 'Rapid Test (COVID-19, HIV, HCV, DBD, NAPZA), Vacuum Tube, Glucose Test Strip, Sarung Tangan, Masker Medis, Safety Box',
                'icon' => 'fas fa-vial',
                'link' => route('products.category', 'produk-konsumabel')
            ],
            [
                'title' => 'Linen & Apparel RS',
                'description' => 'Produk linen E2E: baju medis, bed cover, dan produk tekstil RS lainnya dengan kualitas tinggi dan standar internasional',
                'icon' => 'fas fa-tshirt',
                'link' => route('products.category', 'linen-apparel-rs')
            ],
            [
                'title' => 'Jasa Konsultan & Maintenance',
                'description' => 'Kalibrasi alat kesehatan, Konsultasi pengadaan & teknis RS dan Lab, Layanan service dan perbaikan peralatan medis',
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
