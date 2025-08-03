<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        // Tampilkan semua tugas
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    // Fungsi-fungsi lainnya seperti store, show, update, delete, dll. sesuai kebutuhan.
}
