<?php
// app/Http/Controllers/Admin/AdminRedeemController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Redeem;

class AdminRedeemController extends Controller
{
    public function redeems(Request $request)
    {
        // Ambil nilai sort dan direction dari URL
        $sortColumn = $request->query('sort', 'updated_at'); // Defaultnya adalah kolom updated_at
        $sortDirection = $request->query('direction', 'desc'); // Defaultnya adalah descending

        // Query untuk pending redeems
        $pendingRedeems = Redeem::where('status', 'pending')
            ->orderBy($sortColumn, $sortDirection)
            ->get();

        // Query untuk approved/rejected redeems
        $actionRedeems = Redeem::whereIn('status', ['approve', 'reject'])
            ->orderBy($sortColumn, $sortDirection)
            ->get();

        // Kirim data ke tampilan
        return view('admin.redeems', compact('pendingRedeems', 'actionRedeems', 'sortDirection'));
    }

    public function approve($id)
    {
        $redeem = Redeem::findOrFail($id);
        $redeem->status = 'approve';
        $redeem->save();

        return redirect()->route('admin.redeems')->with('success', 'Redeem approved successfully');
    }

    public function reject($id)
    {
        $redeem = Redeem::findOrFail($id);
        $redeem->status = 'reject';
        $redeem->save();

        return redirect()->route('admin.redeems')->with('success', 'Redeem rejected successfully');
    }
}
