<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Redeem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RedeemController extends Controller
{
    // Method untuk menampilkan daftar penarikan
    public function index()
    {
        // Ambil semua data penarikan dari database
        $redeems = Redeem::all();

        // Kirim data penarikan ke view
        return view('redeems.index', compact('redeems'));
    }

    // Method untuk menampilkan halaman pembuatan penarikan
    public function create()
    {
        return view('redeems.create');
    }

    // Method untuk menyimpan penarikan yang diajukan
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'owner_name' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'amount' => 'required|numeric|min:50',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Validasi apakah jumlah poin mencukupi
        if ($user->points < $request->amount) {
            return back()->with('error', 'Insufficient points.');
        }

        // Kurangi poin pengguna sesuai dengan jumlah penarikan
        User::where('id', $user->id)->decrement('points', $request->amount);

        // Simpan data penarikan
        Redeem::create([
            'user_id' => $user->id,
            'owner_name' => $request->owner_name,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        // Redirect pengguna kembali ke halaman redeems.index dengan pesan sukses
        return redirect()->route('redeems.index')->with('success', 'Redeem request submitted successfully.');
    }
}
