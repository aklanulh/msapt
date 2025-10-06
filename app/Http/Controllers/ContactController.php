<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contact_info = [
            'address' => 'Ruko Maison Avenue MA.19, Kota Wisata, Cibubur, Kabupaten Bogor, 16820',
            'whatsapp' => '0811 9466 470',
            'email' => 'mitrajayaselarasabadi@gmail.com',
            'email_cs' => '',
            'email_alt' => '',
            'website' => 'www.ptmsa.co.id',
            'office_hours' => 'Senin - Jumat: 08:00 - 17:00 WIB',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.748684284785!2d106.96004352475438!3d-6.381105261549892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6995cd270379f1%3A0xc9fa186bdf6bb544!2sPT.%20MITRAJAYA%20SELARAS%20ABADI!5e0!3m2!1sen!2sid!4v1726110123456'
        ];

        return view('contact', compact('contact_info'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // In a real application, you would save to database and send email
        // For now, we'll just redirect with success message

        return redirect()->route('contact')->with('success', 'Pesan Anda telah berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }
}
