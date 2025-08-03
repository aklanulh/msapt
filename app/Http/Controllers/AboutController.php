<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $companyInfo = [
            'name' => 'PT. Mitrajaya Selaras Abadi (MSA)',
            'established' => '2010',
            'description' => 'Distributor dan subdistributor alat kesehatan serta perlengkapan rumah sakit dengan komitmen tinggi terhadap kualitas dan pelayanan. Kami menyediakan produk-produk kesehatan impor berkualitas tinggi yang telah memenuhi standar internasional dan digunakan oleh berbagai rumah sakit ternama di Indonesia.',
            'vision' => 'Menjadi perusahaan yang tumbuh selaras, handal, dan terpercaya dengan standar internasional dalam penyediaan peralatan kesehatan, menjaga kualitas produk dan layanan, serta menjadi distributor alat kesehatan yang kompetitif baik di tingkat daerah maupun nasional. Fokus pada zero defect delivery, peningkatan layanan, dan kepuasan pelanggan.',
            'mission' => [
                'Memenuhi kebutuhan masyarakat atas peralatan kesehatan berkualitas dan berdaya saing',
                'Menyediakan alat kesehatan yang aman dan sesuai standar',
                'Memadukan jasa pengiriman, bea cukai, gudang, dan distribusi dalam satu sistem terintegrasi',
                'Memanfaatkan jaringan dan infrastruktur yang ada untuk mendukung perputaran ekonomi nasional',
                'Mengoptimalkan teknologi untuk pertumbuhan berkelanjutan dan kesejahteraan karyawan',
                'Memberikan pelayanan terbaik dan menjaga tanggung jawab sosial perusahaan'
            ],
            'history' => [
                [
                    'year' => '2010',
                    'event' => 'Pendirian PT Mitrajaya Selaras Abadi'
                ],
                [
                    'year' => '2012',
                    'event' => 'Ekspansi ke bidang alat laboratorium'
                ],
                [
                    'year' => '2015',
                    'event' => 'Sertifikasi ISO 9001:2015'
                ],
                [
                    'year' => '2018',
                    'event' => 'Pembukaan divisi jasa konsultan'
                ],
                [
                    'year' => '2020',
                    'event' => 'Kemitraan dengan brand internasional'
                ],
                [
                    'year' => '2023',
                    'event' => 'Melayani 500+ institusi kesehatan'
                ]
            ],
            'legal' => [
                'company_name' => 'PT. Mitrajaya Selaras Abadi (MSA)',
                'registration' => 'Terdaftar dalam sistem pengadaan elektronik LKPP – LPSE – SIKAP',
                'documents' => 'NIB, IDAK, dan seluruh dokumen hukum tersedia dan sah',
                'address' => 'Ruko Maison Avenue MA.19, Kota Wisata, Cibubur, Kabupaten Bogor, 16820',
                'phone' => '(021) 824-82412',
                'whatsapp' => '0811 9466 470',
                'emails' => ['marketing@ptmsa.biz.id', 'cs@ptmsa.biz.id', 'mitrajayaselarasabadi@gmail.com'],
                'website' => 'www.ptmsa.biz.id'
            ]
        ];

        return view('about', compact('companyInfo'));
    }
}
