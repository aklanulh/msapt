<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        // Mengambil submission yang masih pending milik pengguna yang saat ini masuk
        $pendingSubmissions = Submission::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        // Mengambil submission yang sudah diapprove atau direject milik pengguna yang saat ini masuk
        $approvedRejectedSubmissions = Submission::where('user_id', Auth::id())
            ->where('status', '<>', 'pending')
            ->get();

        return view('submissions.index', compact('pendingSubmissions', 'approvedRejectedSubmissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'submission_url' => 'required|url',
        ]);

        $submissionData = [
            'user_id' => Auth::id(),
            'task_id' => $request->task_id,
            'submission_url' => $request->submission_url,
            'status' => 'pending',
        ];

        Submission::updateOrCreate(
            ['user_id' => Auth::id(), 'task_id' => $request->task_id],
            $submissionData
        );

        return redirect()->route('tasks.show', $request->task_id)->with('status', 'Submission successful!');
    }

    // Fungsi-fungsi lainnya seperti show, update, delete, dll. sesuai kebutuhan.
}
