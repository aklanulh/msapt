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
            'vision' => 'Menjadi perusahaan yang tumbuh selaras, handal dan terpercaya dengan standard Internasional di bidang penyediaan peralatan kesehatanaan dengan menjaga kualitas produk- produk dan layanan service/ perbaikan peralatan kesehatan sehingga dapat menjadi perusahaan distributor alat kesehatan yang mempunyai daya saing dan menjadi pemain alat kesehatan terkemuka di daerah dan di luar daerah. Keamanan dan ketepatan waktu pengiriman, sehingga tercapai zero default quality dan delivery. Berkembang terus dalam meningkatkan kapasitas dan kualitas layanan dengan pelayanan yang prima sehingga tercapai kepuasan pelanggan.',
            'mission' => [
                'Memenuhi kebutuhan masyarakat akan peralatan kesehatan yang mempunyai keunggulan kompetitif',
                'Menyediakan dan menyalurkan alat-alat kesehatan yang merupakan produk terbaik dari segi standar keamanan dan kualitas',
                'Memadukan jasa pengiriman, kepabeanan, pergudangan dan pendistribusian dalam satu sistem yang terintegrasi secara efektif, efisien dan flexible',
                'Mendayagunakan jaringan dan infrastruktur yang dimiliki sebagai kontribusi pada proses perputaran roda ekonomi dengan di dukung oleh SDM yang profesional dan memiliki integritas moral yang tinggi',
                'Memanfaatkan perkembangan teknologi secara tepat, guna mendorong pertumbuhan usaha yang berkesinambungan dalam rangka mencapai kesejahteraan karyawan dan senantiasa meningkatkan tanggung jawab sosial',
                'Memberikan pelayanan terbaik kepada konsumen'
            ],
            'legal' => [
                'company_name' => 'PT. Mitrajaya Selaras Abadi (MSA)',
                'registration' => 'Terdaftar dalam sistem pengadaan elektronik LKPP – LPSE – SIKAP',
                'documents' => 'NIB, IDAK, dan seluruh dokumen hukum tersedia dan sah',
                'address' => 'Ruko Maison Avenue MA.19, Kota Wisata, Cibubur, Kabupaten Bogor, 16820',
                'whatsapp' => '0811 9466 470',
                'emails' => ['mitrajayaselarasabadi@gmail.com', 'cs@ptmsa.biz.id', 'marketing@ptmsa.biz.id'],
                'website' => 'www.ptmsa.biz.id'
            ]
        ];

        return view('about', compact('companyInfo'));
    }
}
