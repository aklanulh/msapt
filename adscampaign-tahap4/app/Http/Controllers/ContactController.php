<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan halaman kontak
        return view('contact.index');
    }
}
