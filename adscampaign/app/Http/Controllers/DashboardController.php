<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Redeem;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil submissions pengguna berdasarkan status
        $totalSubmissions = Submission::where('user_id', $userId)->count();
        $pendingSubmissions = Submission::where('user_id', $userId)->where('status', 'pending')->count();
        $approvedSubmissions = Submission::where('user_id', $userId)->where('status', 'approve')->count();
        $rejectedSubmissions = Submission::where('user_id', $userId)->where('status', 'reject')->count();

        // Mengambil redeems pengguna berdasarkan status
        $totalRedeems = Redeem::where('user_id', $userId)->count();
        $pendingRedeems = Redeem::where('user_id', $userId)->where('status', 'pending')->count();
        $approvedRedeems = Redeem::where('user_id', $userId)->where('status', 'approve')->count();
        $rejectedRedeems = Redeem::where('user_id', $userId)->where('status', 'reject')->count();

        // Pass the data to the view
        return view('dashboard', compact(
            'totalSubmissions',
            'pendingSubmissions',
            'approvedSubmissions',
            'rejectedSubmissions',
            'totalRedeems',
            'pendingRedeems',
            'approvedRedeems',
            'rejectedRedeems'
        ));
    }
}
