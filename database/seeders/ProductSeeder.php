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
            // Alat Kesehatan & Laboratorium
            [
                'name' => 'Hematology Analyzer Mindray BC 700 Series',
                'brand' => 'Mindray',
                'model' => 'BC 700 Series',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Analyzer hematologi otomatis dengan teknologi canggih untuk pemeriksaan darah lengkap dengan akurasi tinggi dan throughput optimal',
                'features' => ['Fully automated', 'High throughput', 'Quality control', 'User-friendly interface', 'Reliable results'],
                'specs' => ['Model' => 'BC 700 Series', 'Throughput' => '60 sampel/jam', 'Parameters' => '26 parameter + 3 histogram', 'Sample Volume' => '20 μL'],
                'applications' => ['Laboratory management', 'Data integration', 'Workflow automation'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Chemistry Analyzer Mindray BS-240 Pro',
                'brand' => 'Mindray',
                'model' => 'BS-240 Pro',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Analyzer kimia klinis otomatis untuk pemeriksaan biokimia darah dengan presisi tinggi dan reliabilitas terjamin',
                'features' => ['Fully automated', 'High precision', 'Wide test menu', 'Compact design', 'User-friendly'],
                'specs' => ['model' => 'BS-240 Pro', 'throughput' => '240 tes/jam', 'sample_volume' => 'Minimal', 'reagent_management' => 'Otomatis'],
                'applications' => ['Rumah Sakit', 'Laboratorium Klinik'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Urine Analyzer Mindray UA-600T',
                'brand' => 'Mindray',
                'model' => 'UA-600T',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Analyzer urine otomatis untuk pemeriksaan urinalisis lengkap dengan akurasi tinggi dan hasil cepat',
                'features' => ['Automated analysis', 'High accuracy', 'Fast results', 'Easy operation', 'Quality control'],
                'specs' => ['model' => 'UA-600T', 'throughput' => '600 sampel/jam', 'parameters' => '14 parameter', 'sample_volume' => '1.2 mL'],
                'applications' => ['Rumah Sakit', 'Laboratorium Klinik', 'Klinik'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Blood Gas & Electrolyte Analyzer Edan I15',
                'brand' => 'Edan',
                'model' => 'I15',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Analyzer gas darah dan elektrolit untuk pemeriksaan pH, pCO2, pO2, dan elektrolit dengan akurasi tinggi',
                'features' => ['Point-of-care testing', 'Fast results', 'Easy maintenance', 'Quality control', 'Compact design'],
                'specs' => ['model' => 'I15', 'parameters' => 'pH, pCO2, pO2, Na+, K+, Cl-', 'sample_volume' => '65 μL', 'test_time' => '60 detik'],
                'applications' => ['Emergency Room', 'ICU', 'Laboratorium'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Blood Gas & Electrolyte Analyzer Edan I500',
                'brand' => 'Edan',
                'model' => 'I500',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Analyzer gas darah dan elektrolit dengan kapasitas lebih besar untuk laboratorium dengan volume tinggi',
                'features' => ['High throughput', 'Extended parameters', 'Auto calibration', 'Data management', 'Network connectivity'],
                'specs' => ['model' => 'I500', 'parameters' => 'Extended panel', 'sample_volume' => 'Minimal', 'connectivity' => 'LIS/HIS integration'],
                'applications' => ['Rumah Sakit Besar', 'Laboratorium Sentral'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Patient Monitor',
                'brand' => 'Various',
                'model' => 'Multi-model',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Monitor pasien multiparameter untuk ICU dan ruang perawatan dengan TKDN 40-47%',
                'features' => ['Multi-parameter monitoring', 'TKDN 40-47%', 'Wireless connectivity', 'Alarm management', 'Touch screen'],
                'specs' => ['tkdn' => '40-47%', 'parameters' => 'ECG, SpO2, NIBP, Temp, Resp', 'display' => 'Color LCD', 'connectivity' => 'Network ready'],
                'applications' => ['ICU', 'PICU', 'NICU', 'Ruang Perawatan'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Infusion Pump',
                'brand' => 'Various',
                'model' => 'Medical Infusion Pump',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Pompa infus dengan layar warna 3.2 inch, waterproof IPX2, dan kompatibel dengan semua infusion sets',
                'features' => ['Waterproof IPX2', '3.2 inch color screen', 'Manual & auto bolus', 'Universal compatibility'],
                'specs' => ['display' => '3.2 inch color screen', 'protection' => 'IPX2 waterproof', 'bolus' => 'Manual & automatic', 'compatibility' => 'All infusion sets'],
                'applications' => ['ICU', 'Ruang Operasi', 'Ruang Perawatan'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Syringe Pump',
                'brand' => 'Various',
                'model' => 'Medical Syringe Pump',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Pompa syringe dengan dual screen LED & LCD, waterproof IPX2, dan sistem bolus otomatis',
                'features' => ['Dual screen LED & LCD', 'Waterproof IPX2', 'Auto bolus', 'Universal compatibility'],
                'specs' => ['display' => 'Dual LED & LCD', 'protection' => 'IPX2 waterproof', 'bolus' => 'Manual & automatic', 'compatibility' => 'All infusion sets'],
                'applications' => ['ICU', 'Pediatric Care', 'Anesthesia'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Ventilator Accubreathe VI 30/40',
                'brand' => 'Various',
                'model' => 'Accubreathe VI 30/40',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Ventilator canggih dengan sistem dual drive, interface yang dapat dikustomisasi, dan dukungan ventilasi lanjutan',
                'features' => ['Advanced ventilation support', 'Real-time display', 'Customized interface', 'Double drive system'],
                'specs' => ['models' => 'VI 30 & VI 40', 'system' => 'Double Drive System', 'display' => 'Real-time monitoring', 'interface' => 'Customizable'],
                'applications' => ['ICU', 'Emergency', 'Operating Room'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Electrocardiography (ECG)',
                'brand' => 'Various',
                'model' => '3-Channel ECG',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'ECG 3-channel dengan layar LCD touch 4.3 inch, filter setting support, dan multi-format report',
                'features' => ['3-channel recording', '4.3 inch touch LCD', 'Filter setting', 'Multi-format report'],
                'specs' => ['channels' => '3-channel', 'display' => '4.3 inch color LCD touch', 'features' => 'Filter setting support', 'output' => 'Multi-format report'],
                'applications' => ['Cardiology', 'Emergency', 'General Practice'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Mesin Anestesi',
                'brand' => 'Various',
                'model' => 'Anesthesia Machine',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Mesin anestesi dengan teknologi canggih untuk mendukung prosedur operasi dengan keamanan optimal',
                'features' => ['Advanced anesthesia delivery', 'Safety monitoring', 'Precise control', 'User-friendly interface'],
                'specs' => ['type' => 'Anesthesia Machine', 'safety' => 'Multi-level monitoring', 'control' => 'Precise gas delivery', 'interface' => 'Touch screen'],
                'applications' => ['Operating Room', 'Day Surgery'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Defibrillator Monitor Accushock 60',
                'brand' => 'Various',
                'model' => 'Accushock 60',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Defibrilator monitor dengan thermal printer, voice recording storage, dan desain anti shock & anti fall',
                'features' => ['Thermal printer', 'Voice recording storage', 'Durable battery', 'Anti shock & fall'],
                'specs' => ['model' => 'Accushock 60', 'printer' => 'Thermal printer built-in', 'recording' => 'Voice storage', 'protection' => 'Anti shock & anti fall'],
                'applications' => ['Emergency', 'Ambulance', 'ICU'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Doppler',
                'brand' => 'Various',
                'model' => 'Doppler Ultrasound',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Doppler ultrasound untuk pemeriksaan aliran darah dan diagnostik vaskular',
                'features' => ['Vascular diagnostics', 'Blood flow analysis', 'Portable design', 'High sensitivity'],
                'specs' => ['type' => 'Doppler Ultrasound', 'frequency' => 'Multi-frequency', 'display' => 'Digital display', 'portability' => 'Portable'],
                'applications' => ['Vascular Surgery', 'Cardiology', 'Emergency'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'ICU / PICU / NICU Equipment',
                'brand' => 'Various',
                'model' => 'ICU Equipment',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Peralatan lengkap untuk ICU, PICU, dan NICU dengan teknologi monitoring canggih',
                'features' => ['Complete ICU setup', 'Advanced monitoring', 'Pediatric compatible', 'Network integration'],
                'specs' => ['coverage' => 'ICU/PICU/NICU', 'monitoring' => 'Multi-parameter', 'connectivity' => 'Network ready', 'compatibility' => 'All age groups'],
                'applications' => ['ICU', 'PICU', 'NICU'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Ultrasound',
                'brand' => 'Various',
                'model' => 'Ultrasound System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem ultrasound untuk diagnostik imaging dengan kualitas gambar tinggi',
                'features' => ['High-resolution imaging', 'Multiple probes', 'Digital processing', 'User-friendly interface'],
                'specs' => ['imaging' => 'High resolution', 'probes' => 'Multiple transducers', 'processing' => 'Digital', 'display' => 'Color LCD'],
                'applications' => ['Radiology', 'Obstetrics', 'Cardiology'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'C-Arm',
                'brand' => 'Various',
                'model' => 'C-Arm System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem C-Arm untuk fluoroscopy dan imaging intraoperatif',
                'features' => ['Fluoroscopy imaging', 'Mobile design', 'High-quality images', 'Easy positioning'],
                'specs' => ['type' => 'C-Arm System', 'mobility' => 'Mobile', 'imaging' => 'Fluoroscopy', 'positioning' => 'Multi-angle'],
                'applications' => ['Operating Room', 'Orthopedic Surgery', 'Interventional Procedures'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Mobile X-Ray',
                'brand' => 'Various',
                'model' => 'Mobile X-Ray Unit',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Unit X-Ray mobile untuk pemeriksaan radiologi di berbagai lokasi',
                'features' => ['Mobile design', 'Digital imaging', 'Battery powered', 'Easy operation'],
                'specs' => ['type' => 'Mobile X-Ray', 'power' => 'Battery operated', 'imaging' => 'Digital', 'mobility' => 'Fully mobile'],
                'applications' => ['Emergency', 'ICU', 'Ward imaging'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Digital Mammography',
                'brand' => 'Various',
                'model' => 'Digital Mammography System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem mammografi digital untuk screening dan diagnostik kanker payudara',
                'features' => ['Digital imaging', 'High resolution', 'Low dose radiation', 'CAD compatible'],
                'specs' => ['type' => 'Digital Mammography', 'resolution' => 'High resolution', 'radiation' => 'Low dose', 'cad' => 'CAD compatible'],
                'applications' => ['Breast Cancer Screening', 'Diagnostic Imaging', 'Women\'s Health'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'MRI',
                'brand' => 'Various',
                'model' => 'MRI System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem MRI untuk imaging diagnostik dengan resolusi tinggi',
                'features' => ['High-field imaging', 'Advanced sequences', 'Patient comfort', 'Fast scanning'],
                'specs' => ['type' => 'MRI System', 'field_strength' => 'High field', 'sequences' => 'Advanced', 'comfort' => 'Patient-friendly'],
                'applications' => ['Neuroimaging', 'Musculoskeletal', 'Cardiac Imaging'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Stationary X-Ray',
                'brand' => 'Various',
                'model' => 'Stationary X-Ray System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem X-Ray stasioner untuk pemeriksaan radiologi rutin',
                'features' => ['High-quality imaging', 'Digital processing', 'Automated exposure', 'PACS integration'],
                'specs' => ['type' => 'Stationary X-Ray', 'processing' => 'Digital', 'exposure' => 'Automated', 'integration' => 'PACS ready'],
                'applications' => ['General Radiology', 'Emergency', 'Outpatient Imaging'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Surgical Instruments',
                'brand' => 'Various',
                'model' => 'Surgical Instrument Set',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Set instrumen bedah lengkap untuk berbagai prosedur operasi',
                'features' => ['Complete surgical set', 'High-quality steel', 'Sterilizable', 'Ergonomic design'],
                'specs' => ['material' => 'Stainless steel', 'sterilization' => 'Autoclavable', 'design' => 'Ergonomic', 'coverage' => 'Multiple procedures'],
                'applications' => ['General Surgery', 'Specialized Procedures', 'Emergency Surgery'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Operating Table',
                'brand' => 'Various',
                'model' => 'Operating Table System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Meja operasi dengan sistem positioning canggih untuk berbagai prosedur bedah',
                'features' => ['Multi-position capability', 'Electric control', 'Radiolucent top', 'Easy cleaning'],
                'specs' => ['positioning' => 'Multi-position', 'control' => 'Electric', 'top' => 'Radiolucent', 'maintenance' => 'Easy clean'],
                'applications' => ['General Surgery', 'Orthopedic Surgery', 'Specialized Procedures'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Laboratory Information System (LIS)',
                'brand' => 'MSA IT Solutions',
                'model' => 'LIS System',
                'category' => 'alat-kesehatan-laboratorium',
                'description' => 'Sistem informasi laboratorium untuk manajemen data dan workflow laboratorium',
                'features' => ['Complete lab management', 'Data integration', 'Quality control', 'Reporting system'],
                'specs' => ['coverage' => 'Complete LIS', 'integration' => 'Multi-system', 'qc' => 'Built-in QC', 'reporting' => 'Comprehensive'],
                'applications' => ['Laboratory Management', 'Data Integration', 'Quality Assurance'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],

            // Produk Konsumabel
            [
                'name' => 'DS Diluent - Reagent Hematology',
                'brand' => 'Diasys',
                'model' => 'DS Diluent',
                'category' => 'produk-konsumabel',
                'description' => 'Reagent diluent untuk analyzer hematologi dengan kualitas tinggi dan stabilitas optimal',
                'features' => ['High purity', 'Stable formulation', 'Compatible with analyzers', 'Long shelf life'],
                'specs' => ['type' => 'Hematology Diluent', 'purity' => 'High purity', 'stability' => 'Long-term stable', 'compatibility' => 'Multi-analyzer'],
                'applications' => ['Hematology Analysis', 'Blood Cell Counting', 'Laboratory Testing'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'SC Cal Plus - Reagent Hematology',
                'brand' => 'Diasys',
                'model' => 'SC Cal Plus',
                'category' => 'produk-konsumabel',
                'description' => 'Calibrator untuk analyzer hematologi dengan akurasi tinggi dan traceability terjamin',
                'features' => ['High accuracy', 'Traceable values', 'Multi-parameter', 'Quality assured'],
                'specs' => ['type' => 'Hematology Calibrator', 'accuracy' => 'High precision', 'traceability' => 'Certified', 'parameters' => 'Multi-parameter'],
                'applications' => ['Calibration', 'Quality Control', 'Accuracy Verification'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Safety Box Vicom',
                'brand' => 'Vicom',
                'model' => 'Standard',
                'category' => 'produk-konsumabel',
                'description' => 'Safety box untuk pembuangan limbah medis dengan standar keamanan tinggi',
                'features' => ['Medical waste disposal', 'Safety compliant', 'Puncture resistant', 'Color coded'],
                'specs' => ['type' => 'Medical Waste Container', 'safety' => 'Puncture resistant', 'compliance' => 'Medical standards', 'coding' => 'Color coded'],
                'applications' => ['Waste Management', 'Infection Control', 'Laboratory Safety'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],

            // Linen & Apparel RS
            [
                'name' => 'Surgical Face Mask',
                'brand' => 'Medicom',
                'model' => '3-Ply',
                'category' => 'linen-apparel-rs',
                'description' => 'Masker bedah 3-ply dengan filtrasi tinggi untuk perlindungan optimal',
                'features' => ['3-ply construction', 'High filtration', 'Comfortable fit', 'Latex-free'],
                'specs' => ['layers' => '3-ply', 'filtration' => 'High efficiency', 'comfort' => 'Comfortable', 'material' => 'Latex-free'],
                'applications' => ['Surgery', 'Patient Care', 'Infection Control'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Sarung Tangan Cosmomed',
                'brand' => 'Cosmomed',
                'model' => 'Latex Powder-Free',
                'category' => 'linen-apparel-rs',
                'description' => 'Sarung tangan latex powder-free untuk prosedur medis dengan sensitivitas tinggi',
                'features' => ['Powder-free', 'High sensitivity', 'Latex material', 'Disposable'],
                'specs' => ['material' => 'Latex', 'powder' => 'Powder-free', 'sensitivity' => 'High tactile', 'usage' => 'Single use'],
                'applications' => ['Medical Procedures', 'Patient Examination', 'Laboratory Work'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],

            // Jasa Konsultan & Maintenance
            [
                'name' => 'Kalibrasi Alat Medis & Laboratorium',
                'brand' => 'MSA',
                'model' => 'Comprehensive Service',
                'category' => 'jasa-konsultan-maintenance',
                'description' => 'Layanan kalibrasi komprehensif untuk alat medis dan laboratorium dengan sertifikat terakreditasi',
                'features' => ['Accredited calibration', 'Comprehensive service', 'Certified technicians', 'Documentation'],
                'specs' => ['accreditation' => 'ISO/IEC 17025', 'coverage' => 'Medical & Lab equipment', 'certification' => 'Traceable certificates', 'technicians' => 'Certified'],
                'applications' => ['Equipment Calibration', 'Quality Assurance', 'Regulatory Compliance'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ],
            [
                'name' => 'Instalasi Operating Theatre (MOT)',
                'brand' => 'MSA',
                'model' => 'Turnkey Solution',
                'category' => 'jasa-konsultan-maintenance',
                'description' => 'Solusi turnkey untuk instalasi ruang operasi modern dengan standar internasional',
                'features' => ['Turnkey solution', 'International standards', 'Complete installation', 'Project management'],
                'specs' => ['solution' => 'Turnkey', 'standards' => 'International', 'coverage' => 'Complete OR setup', 'management' => 'Full project'],
                'applications' => ['Operating Room Setup', 'Hospital Construction', 'Medical Facility Upgrade'],
                'price_range' => 'Hubungi untuk harga',
                'is_active' => true
            ]
        ];

        // Insert products using create method for automatic timestamps
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
