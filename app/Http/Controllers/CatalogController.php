<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = [
            [
                'title' => 'Katalog Alat Kesehatan 2024',
                'description' => 'Katalog lengkap peralatan medis dan alat kesehatan terbaru',
                'file' => 'catalog-alat-kesehatan-2024.pdf',
                'size' => '15.2 MB',
                'pages' => 120,
                'updated' => '2024-01-15'
            ],
            [
                'title' => 'Katalog Alat Laboratorium 2024',
                'description' => 'Instrumen laboratorium dan peralatan analisis medis',
                'file' => 'catalog-alat-laboratorium-2024.pdf',
                'size' => '12.8 MB',
                'pages' => 95,
                'updated' => '2024-01-10'
            ],
            [
                'title' => 'Katalog Alat Medis 2024',
                'description' => 'Perangkat medis canggih untuk diagnosis dan terapi',
                'file' => 'catalog-alat-medis-2024.pdf',
                'size' => '18.5 MB',
                'pages' => 150,
                'updated' => '2024-01-20'
            ]
        ];

        return view('catalog', compact('catalogs'));
    }
}
