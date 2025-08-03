<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class AdminSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');

        $pendingSubmissions = Submission::where('status', 'pending')
            ->orderBy($sortField, $sortDirection)
            ->get();

        $actionSubmissions = Submission::whereIn('status', ['approve', 'reject'])
            ->orderBy($sortField, $sortDirection)
            ->get();

        return view('admin.submissions', compact('pendingSubmissions', 'actionSubmissions', 'sortField', 'sortDirection'));
    }

    // public function index()
    // { // Ambil submissions yang pending
    //     $pendingSubmissions = Submission::where('status', 'pending')->get();

    //     // Ambil submissions yang sudah diapprove/reject
    //     $actionSubmissions = Submission::whereIn('status', ['approve', 'reject'])->get();

    //     // Kirim data ke tampilan
    //     return view('admin.submissions', compact('pendingSubmissions', 'actionSubmissions'));
    // }

    // Method to approve submission
    public function approve($id)
    {
        // Find the submission by ID
        $submission = Submission::findOrFail($id);

        // Update the status to 'approve'
        $submission->update(['status' => 'approve']);

        // Redirect back with a success message
        return redirect()->route('admin.submissions')->with('success', 'Submission approved successfully.');
    }

    // Method to reject submission
    public function reject($id)
    {
        // Find the submission by ID
        $submission = Submission::findOrFail($id);

        // Update the status to 'reject'
        $submission->update(['status' => 'reject']);

        // Redirect back with a success message
        return redirect()->route('admin.submissions')->with('success', 'Submission rejected successfully.');
    }
}
