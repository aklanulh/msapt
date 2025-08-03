<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        $pendingSubmissions = Submission::with('task')
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->orderBy('submitted_at', 'desc')
            ->get();
        
        $completedSubmissions = Submission::with('task')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'rejected'])
            ->orderBy('updated_at', 'desc')
            ->get();
        
        return view('submissions.index', compact('pendingSubmissions', 'completedSubmissions'));
    }
}
