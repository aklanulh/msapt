<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function index()
    {
        // Tampilkan semua pengiriman
        $submissions = Submission::all();
        return view('submissions.index', compact('submissions'));
    }

    // Fungsi-fungsi lainnya seperti store, show, update, delete, dll. sesuai kebutuhan.
}
