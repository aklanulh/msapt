<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectGallery;

class ProjectGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'client' => 'RS Husada Jakarta',
                'category' => 'Alat Kesehatan',
                'year' => '2023',
                'description' => 'Pengadaan lengkap peralatan ICU termasuk ventilator, monitor pasien, dan infusion pump untuk meningkatkan kualitas pelayanan intensive care unit.',
                'images' => json_encode([]),
                'is_active' => true,
            ],
            [
                'client' => 'RSUD Tangerang',
                'category' => 'Alat Laboratorium',
                'year' => '2023',
                'description' => 'Setup laboratorium patologi lengkap dengan hematology analyzer dan chemistry analyzer untuk mendukung diagnosa yang akurat dan cepat.',
                'images' => json_encode([]),
                'is_active' => true,
            ],
            [
                'client' => 'RS Permata Bekasi',
                'category' => 'Alat Medis',
                'year' => '2022',
                'description' => 'Modernisasi ruang operasi dengan lampu operasi LED, meja operasi elektrik, dan anesthesia machine untuk meningkatkan standar operasi.',
                'images' => json_encode([]),
                'is_active' => true,
            ],
            [
                'client' => 'Dinas Kesehatan Kota Depok',
                'category' => 'Jasa Konsultan',
                'year' => '2023',
                'description' => 'Konsultasi pengadaan alat kesehatan untuk 25 puskesmas di Kota Depok dalam rangka peningkatan fasilitas kesehatan masyarakat.',
                'images' => json_encode([]),
                'is_active' => true,
            ],
            [
                'client' => 'RS Siloam Lippo Village',
                'category' => 'Alat Kesehatan',
                'year' => '2022',
                'description' => 'Pengadaan alat-alat kesehatan untuk unit gawat darurat termasuk defibrillator, ECG machine, dan emergency trolley.',
                'images' => json_encode([]),
                'is_active' => true,
            ],
            [
                'client' => 'RS Mayapada Jakarta Selatan',
                'category' => 'Alat Laboratorium',
                'year' => '2024',
                'description' => 'Instalasi laboratorium mikrobiologi lengkap dengan biosafety cabinet, incubator, dan automated identification system.',
                'images' => json_encode([]),
                'is_active' => true,
            ],
            [
                'client' => 'RSUP Fatmawati',
                'category' => 'Alat Medis',
                'year' => '2023',
                'description' => 'Upgrade peralatan radiologi dengan digital X-ray system dan CT scan untuk meningkatkan akurasi diagnosa.',
                'images' => json_encode([]),
                'is_active' => true,
            ],
            [
                'client' => 'Klinik Kimia Farma',
                'category' => 'Alat Laboratorium',
                'year' => '2024',
                'description' => 'Pengadaan alat laboratorium klinik untuk pemeriksaan rutin termasuk automated analyzer dan centrifuge.',
                'images' => json_encode([]),
                'is_active' => true,
            ],
            [
                'client' => 'RS Pondok Indah',
                'category' => 'Jasa Konsultan',
                'year' => '2022',
                'description' => 'Konsultasi perencanaan dan pengadaan alat kesehatan untuk ekspansi rumah sakit dan peningkatan kapasitas pelayanan.',
                'images' => json_encode([]),
                'is_active' => true,
            ],
            [
                'client' => 'Puskesmas Cibinong',
                'category' => 'Alat Kesehatan',
                'year' => '2024',
                'description' => 'Pengadaan alat kesehatan dasar untuk puskesmas termasuk tensimeter, stetoskop, dan alat pemeriksaan umum.',
                'images' => json_encode([]),
                'is_active' => true,
            ]
        ];

        foreach ($projects as $project) {
            ProjectGallery::create($project);
        }
    }
}
