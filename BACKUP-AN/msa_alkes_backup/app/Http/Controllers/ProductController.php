<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Alat Kesehatan & Laboratorium',
                'slug' => 'alat-kesehatan-laboratorium',
                'description' => 'Hematology Analyzer, Chemistry Analyzer, Urine Analyzer, Blood Gas Analyzer, Patient Monitor, Ventilator, Mobile X-Ray, C-Arm, MRI, Digital Mammography, Ultrasound',
                'image' => 'https://via.placeholder.com/400x300',
                'product_count' => 45
            ],
            [
                'id' => 2,
                'name' => 'Produk Konsumabel',
                'slug' => 'produk-konsumabel',
                'description' => 'Rapid Test (COVID-19, HIV, HCV, DBD, NAPZA), Vacuum Tube, Glucose Test Strip, Sarung Tangan, Masker Medis, Safety Box',
                'image' => 'https://via.placeholder.com/400x300',
                'product_count' => 35
            ],
            [
                'id' => 3,
                'name' => 'Linen & Apparel RS',
                'slug' => 'linen-apparel-rs',
                'description' => 'Produk linen E2E: baju medis, bed cover, dan produk tekstil RS lainnya dengan kualitas tinggi dan standar internasional',
                'image' => 'https://via.placeholder.com/400x300',
                'product_count' => 20
            ],
            [
                'id' => 4,
                'name' => 'Jasa Konsultan & Maintenance',
                'slug' => 'jasa-konsultan-maintenance',
                'description' => 'Kalibrasi alat kesehatan, Konsultasi pengadaan & teknis RS dan Lab, Layanan service dan perbaikan peralatan medis',
                'image' => 'https://via.placeholder.com/400x300',
                'product_count' => 15
            ]
        ];

        return view('products.index', compact('categories'));
    }

    public function category($category)
    {
        $products = $this->getProductsByCategory($category);
        $categoryName = $this->getCategoryName($category);
        
        return view('products.category', compact('products', 'category', 'categoryName'));
    }

    public function show($id)
    {
        $product = $this->getProductById($id);
        $relatedProducts = $this->getRelatedProducts($product['category'], $id);
        
        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $products = $this->searchProducts($query);
        
        return view('products.search', compact('products', 'query'));
    }

    private function getProductsByCategory($category)
    {
        // Sample data - in real app, this would come from database
        $allProducts = [
            'alat-kesehatan-laboratorium' => [
                [
                    'id' => 1,
                    'name' => 'Hematology Analyzer',
                    'brand' => 'Sysmex',
                    'model' => 'XN-1000',
                    'price_range' => 'Hubungi untuk harga',
                    'description' => 'Analyzer hematologi otomatis untuk pemeriksaan darah lengkap dengan akurasi tinggi dan throughput optimal',
                    'image' => 'https://via.placeholder.com/400x300',
                    'category' => 'alat-kesehatan-laboratorium',
                    'features' => ['Throughput tinggi', 'Akurasi tinggi', 'Interface user-friendly', 'Maintenance mudah', 'Garansi 1 tahun'],
                    'specs' => [
                        'Throughput: 100 sampel/jam',
                        'Parameters: 23 parameter + 3 part diff',
                        'Sample Volume: 88 μL',
                        'Garansi: 1 tahun sparepart & servis'
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Chemistry Analyzer',
                    'brand' => 'Roche',
                    'model' => 'Cobas c311',
                    'price_range' => 'Hubungi untuk harga',
                    'description' => 'Analyzer kimia klinis otomatis untuk pemeriksaan biokimia darah dengan presisi tinggi',
                    'image' => 'https://via.placeholder.com/400x300',
                    'category' => 'alat-kesehatan-laboratorium',
                    'features' => ['Fully automated', 'High precision', 'Wide test menu', 'Compact design', 'Garansi 1 tahun'],
                    'specs' => [
                        'Throughput: 300 tes/jam',
                        'Sample Volume: 2-35 μL',
                        'Reagent Positions: 25 posisi',
                        'Garansi: 1 tahun sparepart & servis'
                    ]
                ],
                [
                    'id' => 3,
                    'name' => 'Patient Monitor',
                    'brand' => 'Philips',
                    'model' => 'IntelliVue MX40',
                    'price_range' => 'Hubungi untuk harga',
                    'description' => 'Monitor pasien multiparameter untuk ICU dan ruang perawatan dengan teknologi canggih',
                    'image' => 'https://via.placeholder.com/400x300',
                    'category' => 'alat-kesehatan-laboratorium',
                    'features' => ['Multi-parameter monitoring', 'Wireless connectivity', 'Touch screen', 'Alarm management', 'Garansi 1 tahun'],
                    'specs' => [
                        'Display: 15 inch color LCD',
                        'Parameters: ECG, SpO2, NIBP, Temp, Resp',
                        'Battery Life: 3 jam',
                        'Garansi: 1 tahun sparepart & servis'
                    ]
                ]
            ],
            'produk-konsumabel' => [
                [
                    'id' => 4,
                    'name' => 'Rapid Test COVID-19',
                    'brand' => 'Abbott',
                    'model' => 'Panbio',
                    'price_range' => 'Rp 25.000 - 35.000/test',
                    'description' => 'Rapid test antigen COVID-19 dengan akurasi tinggi dan hasil cepat',
                    'image' => 'https://via.placeholder.com/400x300',
                    'category' => 'produk-konsumabel',
                    'features' => ['Hasil cepat 15 menit', 'Akurasi tinggi', 'Mudah digunakan', 'WHO approved'],
                    'specs' => [
                        'Sensitivitas: 98.1%',
                        'Spesifisitas: 99.8%',
                        'Sample Type: Nasal swab',
                        'Shelf Life: 24 bulan'
                    ]
                ],
                [
                    'id' => 5,
                    'name' => 'Rapid Test HIV',
                    'brand' => 'SD Biosensor',
                    'model' => 'Standard Q',
                    'price_range' => 'Rp 15.000 - 25.000/test',
                    'description' => 'Rapid test HIV 1/2 untuk screening cepat dan akurat',
                    'image' => 'https://via.placeholder.com/400x300',
                    'category' => 'produk-konsumabel',
                    'features' => ['Hasil 15-20 menit', 'Sensitivitas tinggi', 'Mudah interpretasi', 'CE marked'],
                    'specs' => [
                        'Sensitivitas: >99.5%',
                        'Spesifisitas: >99.8%',
                        'Sample Type: Whole blood/Serum/Plasma',
                        'Storage: 2-30°C'
                    ]
                ],
                [
                    'id' => 6,
                    'name' => 'Vacuum Tube EDTA',
                    'brand' => 'BD',
                    'model' => 'Vacutainer',
                    'price_range' => 'Rp 1.500 - 2.500/tube',
                    'description' => 'Vacuum tube dengan antikoagulan EDTA untuk pemeriksaan hematologi',
                    'image' => 'https://via.placeholder.com/400x300',
                    'category' => 'produk-konsumabel',
                    'features' => ['Steril', 'Pre-filled EDTA', 'Color coded', 'Leak-proof'],
                    'specs' => [
                        'Volume: 2-10 mL',
                        'Anticoagulant: K2EDTA',
                        'Material: PET plastic',
                        'Expiry: 3 tahun'
                    ]
                ],
                [
                    'id' => 7,
                    'name' => 'Sarung Tangan Nitrile',
                    'brand' => 'Ansell',
                    'model' => 'TouchNTuff',
                    'price_range' => 'Rp 150.000 - 200.000/box',
                    'description' => 'Sarung tangan nitrile powder-free untuk pemeriksaan medis',
                    'image' => 'https://via.placeholder.com/400x300',
                    'category' => 'produk-konsumabel',
                    'features' => ['Powder-free', 'Latex-free', 'Chemical resistant', 'Textured fingertips'],
                    'specs' => [
                        'Material: 100% Nitrile',
                        'Thickness: 0.12 mm',
                        'Length: 240 mm',
                        'Packaging: 100 pcs/box'
                    ]
                ]
            ],
            'linen-apparel-rs' => [
                [
                    'id' => 8,
                    'name' => 'Baju Medis Scrub',
                    'brand' => 'MSA Linen',
                    'model' => 'Premium Scrub',
                    'price_range' => 'Rp 150.000 - 250.000/set',
                    'description' => 'Baju medis scrub berkualitas tinggi dengan standar internasional',
                    'image' => 'https://via.placeholder.com/400x300',
                    'category' => 'linen-apparel-rs',
                    'features' => ['Anti-bacterial', 'Breathable fabric', 'Easy care', 'Color-fast'],
                    'specs' => [
                        'Material: 65% Polyester, 35% Cotton',
                        'Weight: 180 GSM',
                        'Colors: Green, Blue, White',
                        'Sizes: S, M, L, XL, XXL'
                    ]
                ]
            ],
            'jasa-konsultan-maintenance' => [
                [
                    'id' => 9,
                    'name' => 'Kalibrasi Alat Kesehatan',
                    'brand' => 'MSA Service',
                    'model' => 'Calibration Service',
                    'price_range' => 'Hubungi untuk harga',
                    'description' => 'Layanan kalibrasi profesional untuk semua jenis alat kesehatan dan laboratorium',
                    'image' => 'https://via.placeholder.com/400x300',
                    'category' => 'jasa-konsultan-maintenance',
                    'features' => ['Certified technician', 'ISO 17025 standard', 'Certificate provided', 'On-site service'],
                    'specs' => [
                        'Standard: ISO 17025',
                        'Certificate: Traceable to national standard',
                        'Frequency: Annual/Bi-annual',
                        'Coverage: Seluruh Indonesia'
                    ]
                ]
            ]
        ];

        return $allProducts[$category] ?? [];
    }

    private function getProductById($id)
    {
        // Get all products from all categories
        $allProducts = [];
        $categories = ['alat-kesehatan-laboratorium', 'produk-konsumabel', 'linen-apparel-rs', 'jasa-konsultan-maintenance'];
        
        foreach ($categories as $category) {
            $categoryProducts = $this->getProductsByCategory($category);
            $allProducts = array_merge($allProducts, $categoryProducts);
        }
        
        // Find product by ID
        foreach ($allProducts as $product) {
            if ($product['id'] == $id) {
                return $product;
            }
        }
        
        // Return null if product not found
        return null;
    }

    private function getRelatedProducts($category, $excludeId)
    {
        $products = $this->getProductsByCategory($category);
        return array_filter($products, function($product) use ($excludeId) {
            return $product['id'] != $excludeId;
        });
    }

    private function searchProducts($query)
    {
        // Sample search implementation
        $allProducts = array_merge(
            $this->getProductsByCategory('alat-kesehatan-laboratorium'),
            $this->getProductsByCategory('produk-konsumabel'),
            $this->getProductsByCategory('linen-apparel-rs'),
            $this->getProductsByCategory('jasa-konsultan-maintenance')
        );

        return array_filter($allProducts, function($product) use ($query) {
            return stripos($product['name'], $query) !== false || 
                   stripos($product['brand'], $query) !== false;
        });
    }

    private function getCategoryName($category)
    {
        $names = [
            'alat-kesehatan-laboratorium' => 'Alat Kesehatan & Laboratorium',
            'produk-konsumabel' => 'Produk Konsumabel',
            'linen-apparel-rs' => 'Linen & Apparel RS',
            'jasa-konsultan-maintenance' => 'Jasa Konsultan & Maintenance'
        ];

        return $names[$category] ?? 'Kategori';
    }
}
