<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = [
            [
                'title' => 'Katalog Alat Medis',
                'description' => 'Perangkat medis canggih untuk diagnosis dan terapi',
                'icon' => 'fas fa-stethoscope'
            ],
            [
                'title' => 'Katalog Alat Laboratorium',
                'description' => 'Instrumen laboratorium dan peralatan analisis medis',
                'icon' => 'fas fa-microscope'
            ],
            [
                'title' => 'Katalog Alat BMHP',
                'description' => 'Bahan Medis Habis Pakai untuk kebutuhan medis sehari-hari',
                'icon' => 'fas fa-box-open'
            ]
        ];

        return view('catalog', compact('catalogs'));
    }
}
