<?php

// app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Submission;
use App\Models\Redeem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        // Menghitung total tasks, submissions, dan redeems
        $totalTasks = Task::count();
        $activeTasks = Task::where('deadline', '>', Carbon::now())->count();
        $expiredTasks = Task::where('deadline', '<=', Carbon::now())->count();

        $totalSubmissions = Submission::count();
        $pendingSubmissions = Submission::where('status', 'pending')->count();
        $approvedSubmissions = Submission::where('status', 'approved')->count();
        $rejectedSubmissions = Submission::where('status', 'rejected')->count();

        $totalRedeems = Redeem::count();
        $pendingRedeems = Redeem::where('status', 'pending')->count();
        $approvedRedeems = Redeem::where('status', 'approved')->count();

        // Mendapatkan tasks, submissions, dan redeems terbaru
        $recentTasks = Task::orderBy('updated_at', 'desc')->take(5)->get();
        $recentSubmissions = Submission::orderBy('updated_at', 'desc')->take(5)->get();
        $recentRedeems = Redeem::orderBy('updated_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalTasks',
            'activeTasks',
            'expiredTasks',
            'totalSubmissions',
            'pendingSubmissions',
            'approvedSubmissions',
            'rejectedSubmissions',
            'totalRedeems',
            'pendingRedeems',
            'approvedRedeems',
            'recentTasks',
            'recentSubmissions',
            'recentRedeems'
        ));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // Ubah rute sesuai kebutuhan
    }
}
