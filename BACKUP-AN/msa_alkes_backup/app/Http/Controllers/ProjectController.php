<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = [
            [
                'id' => 1,
                'title' => 'Pengadaan Alat ICU RS Husada',
                'client' => 'RS Husada Jakarta',
                'category' => 'Alat Kesehatan',
                'year' => '2023',
                'value' => 'Rp 2.5 Miliar',
                'description' => 'Pengadaan lengkap peralatan ICU termasuk ventilator, monitor pasien, dan infusion pump',
                'image' => '/images/projects/project-1.jpg',
                'gallery' => [
                    '/images/projects/project-1-1.jpg',
                    '/images/projects/project-1-2.jpg',
                    '/images/projects/project-1-3.jpg'
                ]
            ],
            [
                'id' => 2,
                'title' => 'Laboratorium Patologi RSUD Tangerang',
                'client' => 'RSUD Tangerang',
                'category' => 'Alat Laboratorium',
                'year' => '2023',
                'value' => 'Rp 1.8 Miliar',
                'description' => 'Setup laboratorium patologi lengkap dengan hematology analyzer dan chemistry analyzer',
                'image' => '/images/projects/project-2.jpg',
                'gallery' => [
                    '/images/projects/project-2-1.jpg',
                    '/images/projects/project-2-2.jpg',
                    '/images/projects/project-2-3.jpg'
                ]
            ],
            [
                'id' => 3,
                'title' => 'Modernisasi Ruang Operasi RS Permata',
                'client' => 'RS Permata Bekasi',
                'category' => 'Alat Medis',
                'year' => '2022',
                'value' => 'Rp 3.2 Miliar',
                'description' => 'Upgrade ruang operasi dengan lampu operasi LED, meja operasi elektrik, dan anesthesia machine',
                'image' => '/images/projects/project-3.jpg',
                'gallery' => [
                    '/images/projects/project-3-1.jpg',
                    '/images/projects/project-3-2.jpg',
                    '/images/projects/project-3-3.jpg'
                ]
            ],
            [
                'id' => 4,
                'title' => 'Konsultasi Pengadaan Alkes Puskesmas',
                'client' => 'Dinas Kesehatan Kota Depok',
                'category' => 'Jasa Konsultan',
                'year' => '2023',
                'value' => 'Rp 500 Juta',
                'description' => 'Konsultasi pengadaan alat kesehatan untuk 25 puskesmas di Kota Depok',
                'image' => '/images/projects/project-4.jpg',
                'gallery' => [
                    '/images/projects/project-4-1.jpg',
                    '/images/projects/project-4-2.jpg'
                ]
            ]
        ];

        $stats = [
            'total_projects' => 150,
            'satisfied_clients' => 120,
            'years_experience' => 14,
            'total_value' => 'Rp 50+ Miliar'
        ];

        return view('projects', compact('projects', 'stats'));
    }
}
