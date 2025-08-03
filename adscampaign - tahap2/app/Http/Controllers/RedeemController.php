<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Redeem;

class RedeemController extends Controller
{
    public function index()
    {
        // Tampilkan semua penebusan
        $redeems = Redeem::all();
        return view('redeems.index', compact('redeems'));
    }

    // Fungsi-fungsi lainnya seperti store, show, update, delete, dll. sesuai kebutuhan.
}
