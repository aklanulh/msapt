<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TrustedClient;

class TrustedClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            ['hospital_name' => 'RS Husada Jakarta', 'is_active' => true],
            ['hospital_name' => 'RSUD Tangerang', 'is_active' => true],
            ['hospital_name' => 'RS Permata Bekasi', 'is_active' => true],
            ['hospital_name' => 'RS Siloam Lippo Village', 'is_active' => true],
            ['hospital_name' => 'RS Mayapada Jakarta Selatan', 'is_active' => true],
            ['hospital_name' => 'RSUP Fatmawati', 'is_active' => true],
            ['hospital_name' => 'RS Pondok Indah', 'is_active' => true],
            ['hospital_name' => 'RS Cipto Mangunkusumo', 'is_active' => true],
            ['hospital_name' => 'RS Premier Bintaro', 'is_active' => true],
            ['hospital_name' => 'RS Omni Alam Sutera', 'is_active' => true],
            ['hospital_name' => 'Klinik Kimia Farma', 'is_active' => true],
            ['hospital_name' => 'Laboratorium Prodia', 'is_active' => true],
            ['hospital_name' => 'RS Hermina Depok', 'is_active' => true],
            ['hospital_name' => 'RS Bunda Jakarta', 'is_active' => true],
            ['hospital_name' => 'Puskesmas Cibinong', 'is_active' => true],
            ['hospital_name' => 'RS Mitra Keluarga Kelapa Gading', 'is_active' => true],
            ['hospital_name' => 'RS Awal Bros Tangerang', 'is_active' => true],
            ['hospital_name' => 'RS Columbia Asia Pulomas', 'is_active' => true],
        ];

        foreach ($clients as $client) {
            TrustedClient::create($client);
        }
    }
}
