<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing products
        Product::truncate();

        $products = [
            // Alat Kesehatan & Laboratorium (23 products)
            [
                'name' => 'Hematology Analyzer Mindray BC 700 Series',
                'brand' => 'Mindray',
                'model' => 'BC 700 Series',
                'price_range' => 'Hubungi untuk harga',
                'description' => 'Analyzer hematologi otomatis dengan teknologi canggih untuk pemeriksaan darah lengkap dengan akurasi tinggi dan throughput optimal',
                'image' => 'https://via.placeholder.com/400x300',
                'category' => 'alat-kesehatan-laboratorium',
                'features' => ['Fully automated', 'High throughput', 'Quality control', 'User-friendly interface', 'Reliable results'],
                'specs' => [
                    'Model' => 'BC 700 Series',
                    'Throughput' => '60 sampel/jam',
                    'Parameters' => '26 parameter + 3 histogram',
                    'Sample Volume' => '20 μL'
                ],
                'applications' => ['Laboratory management', 'Data integration', 'Workflow automation'],
                'is_active' => true
            ],
            [
                'name' => 'Chemistry Analyzer Mindray BS-240 Pro',
                'brand' => 'Mindray',
                'model' => 'BS-240 Pro',
                'price_range' => 'Hubungi untuk harga',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Analyzer kimia klinis otomatis untuk pemeriksaan biokimia darah dengan presisi tinggi dan reliabilitas terjamin',
                'features' => ['Fully automated', 'High precision', 'Wide test menu', 'Compact design', 'User-friendly'],
                'specs' => [
                    'model' => 'BS-240 Pro',
                    'throughput' => '240 tes/jam',
                    'sample_volume' => 'Minimal',
                    'reagent_management' => 'Otomatis'
                ],
                'applications' => ['Rumah Sakit', 'Laboratorium Klinik'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Urine Analyzer Mindray UA-600T',
                'brand' => 'Mindray',
                'model' => 'UA-600T',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Analyzer urine otomatis untuk pemeriksaan urinalisis lengkap dengan akurasi tinggi dan hasil cepat',
                'features' => ['Automated analysis', 'High accuracy', 'Fast results', 'Easy operation', 'Quality control'],
                'specs' => [
                    'model' => 'UA-600T',
                    'throughput' => '600 sampel/jam',
                    'parameters' => '14 parameter',
                    'sample_volume' => '1.2 mL'
                ],
                'applications' => ['Rumah Sakit', 'Laboratorium Klinik', 'Klinik'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Blood Gas & Electrolyte Analyzer Edan I15',
                'brand' => 'Edan',
                'model' => 'I15',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Analyzer gas darah dan elektrolit untuk pemeriksaan pH, pCO2, pO2, dan elektrolit dengan akurasi tinggi',
                'features' => ['Point-of-care testing', 'Fast results', 'Easy maintenance', 'Quality control', 'Compact design'],
                'specs' => [
                    'model' => 'I15',
                    'parameters' => 'pH, pCO2, pO2, Na+, K+, Cl-',
                    'sample_volume' => '65 μL',
                    'test_time' => '60 detik'
                ],
                'applications' => ['Emergency Room', 'ICU', 'Laboratorium'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Blood Gas & Electrolyte Analyzer Edan I500',
                'brand' => 'Edan',
                'model' => 'I500',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Analyzer gas darah dan elektrolit dengan kapasitas lebih besar untuk laboratorium dengan volume tinggi',
                'features' => ['High throughput', 'Extended parameters', 'Auto calibration', 'Data management', 'Network connectivity'],
                'specs' => [
                    'model' => 'I500',
                    'parameters' => 'Extended panel',
                    'sample_volume' => 'Minimal',
                    'connectivity' => 'LIS/HIS integration'
                ],
                'applications' => ['Rumah Sakit Besar', 'Laboratorium Sentral'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Patient Monitor',
                'brand' => 'Various',
                'model' => 'Multi-model',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Monitor pasien multiparameter untuk ICU dan ruang perawatan dengan TKDN 40-47%',
                'features' => ['Multi-parameter monitoring', 'TKDN 40-47%', 'Wireless connectivity', 'Alarm management', 'Touch screen'],
                'specs' => [
                    'tkdn' => '40-47%',
                    'parameters' => 'ECG, SpO2, NIBP, Temp, Resp',
                    'display' => 'Color LCD',
                    'connectivity' => 'Network ready'
                ],
                'applications' => ['ICU', 'PICU', 'NICU', 'Ruang Perawatan'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Infusion Pump',
                'brand' => 'Various',
                'model' => 'Medical Infusion Pump',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Pompa infus dengan layar warna 3.2 inch, waterproof IPX2, dan kompatibel dengan semua infusion sets',
                'features' => ['Waterproof IPX2', '3.2 inch color screen', 'Manual & auto bolus', 'Universal compatibility'],
                'specs' => [
                    'display' => '3.2 inch color screen',
                    'protection' => 'IPX2 waterproof',
                    'bolus' => 'Manual & automatic',
                    'compatibility' => 'All infusion sets'
                ],
                'applications' => ['ICU', 'Ruang Operasi', 'Ruang Perawatan'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Syringe Pump',
                'brand' => 'Various',
                'model' => 'Medical Syringe Pump',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Pompa syringe dengan dual screen LED & LCD, waterproof IPX2, dan sistem bolus otomatis',
                'features' => ['Dual screen LED & LCD', 'Waterproof IPX2', 'Auto bolus', 'Universal compatibility'],
                'specs' => [
                    'display' => 'Dual LED & LCD',
                    'protection' => 'IPX2 waterproof',
                    'bolus' => 'Manual & automatic',
                    'compatibility' => 'All infusion sets'
                ],
                'applications' => ['ICU', 'Pediatric Care', 'Anesthesia'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Ventilator Accubreathe VI 30/40',
                'brand' => 'Various',
                'model' => 'Accubreathe VI 30/40',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Ventilator canggih dengan sistem dual drive, interface yang dapat dikustomisasi, dan dukungan ventilasi lanjutan',
                'features' => ['Advanced ventilation support', 'Real-time display', 'Customized interface', 'Double drive system'],
                'specs' => [
                    'models' => 'VI 30 & VI 40',
                    'system' => 'Double Drive System',
                    'display' => 'Real-time monitoring',
                    'interface' => 'Customizable'
                ],
                'applications' => ['ICU', 'Emergency', 'Operating Room'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Electrocardiography (ECG)',
                'brand' => 'Various',
                'model' => '3-Channel ECG',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'ECG 3-channel dengan layar LCD touch 4.3 inch, filter setting support, dan multi-format report',
                'features' => ['3-channel recording', '4.3 inch touch LCD', 'Filter setting', 'Multi-format report'],
                'specs' => [
                    'channels' => '3-channel',
                    'display' => '4.3 inch color LCD touch',
                    'features' => 'Filter setting support',
                    'output' => 'Multi-format report'
                ],
                'applications' => ['Cardiology', 'Emergency', 'General Practice'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Mesin Anestesi',
                'brand' => 'Various',
                'model' => 'Anesthesia Machine',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Mesin anestesi dengan teknologi canggih untuk mendukung prosedur operasi dengan keamanan optimal',
                'features' => ['Advanced anesthesia delivery', 'Safety monitoring', 'Precise control', 'User-friendly interface'],
                'specs' => [
                    'type' => 'Anesthesia Machine',
                    'safety' => 'Multi-level monitoring',
                    'control' => 'Precise gas delivery',
                    'interface' => 'Touch screen'
                ],
                'applications' => ['Operating Room', 'Day Surgery'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Defibrillator Monitor Accushock 60',
                'brand' => 'Various',
                'model' => 'Accushock 60',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Defibrilator monitor dengan thermal printer, voice recording storage, dan desain anti shock & anti fall',
                'features' => ['Thermal printer', 'Voice recording storage', 'Durable battery', 'Anti shock & fall'],
                'specs' => [
                    'model' => 'Accushock 60',
                    'printer' => 'Thermal printer built-in',
                    'recording' => 'Voice storage',
                    'protection' => 'Anti shock & anti fall'
                ],
                'applications' => ['Emergency', 'Ambulance', 'ICU'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Doppler',
                'brand' => 'Various',
                'model' => 'Doppler Ultrasound',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Doppler dengan desain kompak, OLED display terang, waterproof probes 2 MHz, dan speaker Hi-Fi',
                'features' => ['Compact design', 'Bright OLED display', 'Waterproof probes 2 MHz', 'Hi-Fi speaker', 'AA Battery'],
                'specs' => [
                    'display' => 'Bright OLED',
                    'probes' => 'Waterproof 2 MHz',
                    'audio' => 'Hi-Fi speaker',
                    'power' => 'AA Battery'
                ],
                'applications' => ['Obstetrics', 'Vascular', 'General Practice'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'ICU / PICU / NICU Equipment',
                'brand' => 'Various',
                'model' => 'ICU Equipment',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Peralatan intensive care unit lengkap untuk ICU, PICU, dan NICU dengan teknologi monitoring canggih',
                'features' => ['ICU/PICU/NICU compatible', 'Advanced monitoring', 'Critical care support', 'Multi-parameter'],
                'specs' => [
                    'application' => 'ICU/PICU/NICU',
                    'monitoring' => 'Advanced',
                    'support' => 'Critical care',
                    'parameters' => 'Multi-parameter'
                ],
                'applications' => ['ICU', 'PICU', 'NICU'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Ultrasound',
                'brand' => 'Various',
                'model' => 'Ultrasound System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem ultrasound dengan berbagai jenis probe dan TKDN 45.78% untuk aplikasi diagnostik lengkap',
                'features' => ['TKDN 45.78%', 'Multiple probes', 'High resolution imaging', 'Portable design'],
                'specs' => [
                    'tkdn' => '45.78%',
                    'probes' => 'Multiple types',
                    'imaging' => 'High resolution',
                    'design' => 'Portable'
                ],
                'applications' => ['Radiology', 'Obstetrics', 'Cardiology'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'C-Arm',
                'brand' => 'Various',
                'model' => 'C-Arm System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem C-Arm untuk imaging intraoperatif dengan kualitas gambar tinggi dan mobilitas optimal',
                'features' => ['Intraoperative imaging', 'High image quality', 'Mobile design', 'Easy positioning'],
                'specs' => [
                    'type' => 'C-Arm imaging',
                    'quality' => 'High resolution',
                    'mobility' => 'Mobile design',
                    'application' => 'Intraoperative'
                ],
                'applications' => ['Operating Room', 'Orthopedic Surgery'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Mobile X-Ray',
                'brand' => 'Various',
                'model' => 'Mobile X-Ray Unit',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Unit mobile X-Ray untuk pemeriksaan radiologi di berbagai lokasi dengan kualitas gambar optimal',
                'features' => ['Mobile design', 'High image quality', 'Easy operation', 'Versatile positioning'],
                'specs' => [
                    'type' => 'Mobile X-Ray',
                    'design' => 'Portable',
                    'quality' => 'High resolution',
                    'operation' => 'User-friendly'
                ],
                'applications' => ['ICU', 'Emergency', 'Ward'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Digital Mammography',
                'brand' => 'Various',
                'model' => 'Digital Mammography System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem mammografi digital untuk screening dan diagnostik kanker payudara dengan akurasi tinggi',
                'features' => ['Digital imaging', 'High accuracy', 'Breast cancer screening', 'Low dose radiation'],
                'specs' => [
                    'type' => 'Digital mammography',
                    'application' => 'Breast screening',
                    'accuracy' => 'High',
                    'radiation' => 'Low dose'
                ],
                'applications' => ['Radiology', 'Breast Screening'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'MRI',
                'brand' => 'Various',
                'model' => 'MRI System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem MRI untuk pencitraan medis dengan resolusi tinggi dan teknologi canggih',
                'features' => ['High resolution imaging', 'Advanced technology', 'Non-invasive', 'Multi-sequence'],
                'specs' => [
                    'type' => 'MRI System',
                    'resolution' => 'High',
                    'technology' => 'Advanced',
                    'application' => 'Multi-organ'
                ],
                'applications' => ['Radiology', 'Neurology', 'Orthopedic'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Stationary X-Ray',
                'brand' => 'Various',
                'model' => 'Stationary X-Ray System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem X-Ray stasioner untuk pemeriksaan radiologi rutin dengan kualitas gambar optimal',
                'features' => ['Fixed installation', 'High image quality', 'Routine examinations', 'Digital processing'],
                'specs' => [
                    'type' => 'Stationary X-Ray',
                    'installation' => 'Fixed',
                    'quality' => 'High resolution',
                    'processing' => 'Digital'
                ],
                'applications' => ['Radiology', 'General Practice'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Surgical Instruments',
                'brand' => 'Various',
                'model' => 'Surgical Instrument Set',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Berbagai peralatan bedah berkualitas tinggi untuk mendukung prosedur operasi dengan presisi optimal',
                'features' => ['High quality materials', 'Precision instruments', 'Sterilizable', 'Ergonomic design'],
                'specs' => [
                    'material' => 'Stainless steel',
                    'quality' => 'Medical grade',
                    'sterilization' => 'Autoclavable',
                    'design' => 'Ergonomic'
                ],
                'applications' => ['Operating Room', 'Minor Surgery'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Operating Table',
                'brand' => 'Various',
                'model' => 'Operating Table System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Meja operasi dengan sistem kontrol otomatis dan manual, cocok untuk berbagai jenis operasi termasuk cerebral surgery',
                'features' => ['Kidney bridge elevation', 'Detachable control system', 'Automatic control', 'Low tabletop option'],
                'specs' => [
                    'control' => 'Automatic & Manual',
                    'applications' => 'Various surgeries',
                    'special' => 'Low tabletop for cerebral surgery',
                    'material' => 'Stainless steel'
                ],
                'applications' => ['Operating Room', 'Surgery Center'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Laboratory Information System (LIS)',
                'brand' => 'MSA IT Solutions',
                'model' => 'LIS System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem informasi laboratorium lengkap untuk manajemen data dan workflow laboratorium modern',
                'features' => ['Complete lab management', 'Data integration', 'Workflow automation', 'Report generation'],
                'specs' => [
                    'type' => 'Laboratory Information System',
                    'features' => 'Complete lab management',
                    'integration' => 'Multi-instrument',
                    'reporting' => 'Automated reports'
                ],
                'applications' => ['Laboratorium', 'Hospital Lab'],
                'price_range' => 'Hubungi untuk harga'
            ]
        ];

        // Produk Konsumabel
        $produkKonsumabel = [
            [
                'name' => 'DS Diluent - Reagent Hematology',
                'brand' => 'Diasys',
                'model' => 'DS Diluent',
                'category' => 'produk-konsumabel',
                'description' => 'Reagent diluent untuk hematology analyzer dengan stabilitas tinggi.',
                'features' => [
                    'Stabilitas 18 bulan',
                    'Ready to use',
                    'Kompatibel berbagai analyzer',
                    'Kontrol kualitas ketat',
                    'Kemasan praktis'
                ],
                'specs' => [
                    'volume' => '20L per container',
                    'storage' => '2-8°C',
                    'stability' => '18 months',
                    'ph' => '7.0-7.4',
                    'osmolality' => '290-310 mOsm/kg'
                ],
                'applications' => ['Hematology Analyzer', 'CBC Testing'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'SC Cal Plus - Reagent Hematology',
                'brand' => 'Diasys',
                'model' => 'SC Cal Plus',
                'category' => 'produk-konsumabel',
                'description' => 'Calibrator untuk hematology analyzer dengan akurasi tinggi.',
                'features' => [
                    'Multi-level calibrator',
                    'Traceability NIST',
                    'Long term stability',
                    'Easy to use',
                    'Quality assured'
                ],
                'specs' => [
                    'levels' => '3 levels (Low, Normal, High)',
                    'volume' => '3mL per vial',
                    'storage' => '2-8°C',
                    'stability' => '12 months unopened',
                    'traceability' => 'NIST traceable'
                ],
                'applications' => ['Hematology Calibration', 'Quality Control'],
                'price_range' => 'Hubungi untuk harga'
            ],
            [
                'name' => 'Safety Box Vicom',
                'brand' => 'Vicom',
                'model' => 'Standard',
                'category' => 'produk-konsumabel',
                'description' => 'Safety box untuk disposal jarum suntik dan benda tajam medis.',
                'features' => [
                    'Puncture resistant',
                    'Leak proof design',
                    'Easy disposal',
                    'Color coded',
                    'Various sizes available'
                ],
                'specs' => [
                    'material' => 'High-density polyethylene',
                    'capacity' => '1L, 2L, 5L, 10L',
                    'color' => 'Yellow',
                    'standard' => 'WHO compliant',
                    'closure' => 'Permanent lock'
                ],
                'applications' => ['Rumah Sakit', 'Klinik', 'Laboratorium'],
                'price_range' => 'Rp 15.000 - Rp 75.000'
            ]
        ];

        // Linen & Apparel RS
        $linenApparel = [
            [
                'name' => 'Surgical Face Mask',
                'brand' => 'Medicom',
                'model' => '3-Ply',
                'category' => 'linen-apparel-rs',
                'description' => 'Masker bedah 3 lapis dengan filtrasi tinggi untuk perlindungan optimal.',
                'features' => [
                    '3-layer protection',
                    'Fluid resistant',
                    'Comfortable ear loops',
                    'Latex-free',
                    'Disposable'
                ],
                'specs' => [
                    'filtration' => '>95% BFE',
                    'material' => 'Non-woven polypropylene',
                    'size' => '17.5 x 9.5 cm',
                    'packaging' => '50 pcs/box',
                    'standard' => 'ASTM Level 1'
                ],
                'applications' => ['Bedah', 'Perawatan Pasien', 'Laboratorium'],
                'price_range' => 'Rp 75.000 - Rp 150.000/box'
            ],
            [
                'name' => 'Sarung Tangan Cosmomed',
                'brand' => 'Cosmomed',
                'model' => 'Latex Powder-Free',
                'category' => 'linen-apparel-rs',
                'description' => 'Sarung tangan latex bebas bedak untuk pemeriksaan medis.',
                'features' => [
                    'Powder-free',
                    'High elasticity',
                    'Textured fingertips',
                    'Ambidextrous',
                    'Single use'
                ],
                'specs' => [
                    'material' => 'Natural rubber latex',
                    'thickness' => '0.12mm',
                    'length' => '240mm',
                    'sizes' => 'S, M, L, XL',
                    'packaging' => '100 pcs/box'
                ],
                'applications' => ['Pemeriksaan Medis', 'Laboratorium', 'Dental'],
                'price_range' => 'Rp 85.000 - Rp 120.000/box'
            ]
        ];

        // Jasa Konsultan & Maintenance
        $jasaKonsultan = [
            [
                'name' => 'Kalibrasi Alat Medis & Laboratorium',
                'brand' => 'MSA',
                'model' => 'Comprehensive Service',
                'category' => 'jasa-konsultan-maintenance',
                'description' => 'Layanan kalibrasi profesional untuk alat medis dan laboratorium sesuai standar internasional.',
                'features' => [
                    'Teknisi bersertifikat',
                    'Standar ISO 17025',
                    'Sertifikat kalibrasi',
                    'On-site service',
                    'Dokumentasi lengkap'
                ],
                'specs' => [
                    'standard' => 'ISO 17025:2017',
                    'coverage' => 'Nationwide',
                    'response_time' => '24-48 hours',
                    'certificate' => 'Traceable to national standard',
                    'validity' => '1 year'
                ],
                'applications' => ['Rumah Sakit', 'Laboratorium', 'Klinik'],
                'price_range' => 'Hubungi untuk quotation'
            ],
            [
                'name' => 'Instalasi Operating Theatre (MOT)',
                'brand' => 'MSA',
                'model' => 'Turnkey Solution',
                'category' => 'jasa-konsultan-maintenance',
                'description' => 'Layanan instalasi ruang operasi modern dengan sistem terintegrasi.',
                'features' => [
                    'Design consultation',
                    'Equipment installation',
                    'System integration',
                    'Training & commissioning',
                    'After-sales support'
                ],
                'specs' => [
                    'scope' => 'Complete OR setup',
                    'standards' => 'WHO & MOH compliant',
                    'timeline' => '3-6 months',
                    'warranty' => '1-2 years',
                    'support' => '24/7 technical support'
                ],
                'applications' => ['Rumah Sakit', 'Klinik Bedah'],
                'price_range' => 'Hubungi untuk proposal'
            ]
        ];

        // Merge all product arrays
        $allProducts = array_merge($products, $produkKonsumabel, $linenApparel, $jasaKonsultan);

        // Insert all products
        foreach ($allProducts as $product) {
            Product::create($product);
        }
    }
}
