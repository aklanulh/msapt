<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Submission;
use App\Models\Redeem;

class ContactController extends Controller
{
    public function index()
    {
        $totalUserPoints = User::sum('points');
        $totalPendingSubmissions = Submission::where('status', 'pending')->count();
        $totalApprovedSubmissions = Submission::where('status', 'approve')->count();
        $totalRejectedSubmissions = Submission::where('status', 'reject')->count();
        $totalPendingRedeems = Redeem::where('status', 'pending')->count();
        $totalApprovedRedeems = Redeem::where('status', 'approve')->count();
        $totalRejectedRedeems = Redeem::where('status', 'reject')->count();

        return view('contact.index', compact('totalUserPoints', 'totalPendingSubmissions', 'totalApprovedSubmissions', 'totalRejectedSubmissions', 'totalPendingRedeems', 'totalApprovedRedeems', 'totalRejectedRedeems'));
    }
}
