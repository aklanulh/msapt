<?php

// app/Http/Controllers/Admin/AdminTaskController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class AdminTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('deadline', '>=', Carbon::now())->get();
        $expiredTasks = Task::where('deadline', '<', Carbon::now())->get();

        return view('admin.tasks.index', compact('tasks', 'expiredTasks'));
    }

    public function create()
    {
        return view('admin.tasks.create');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('admin.tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {
        // Temukan task berdasarkan ID
        $task = Task::findOrFail($id);

        // Hapus task
        $task->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully');
    }



    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'points' => 'required|integer',
            'deadline' => 'required|date',
        ]);

        // Simpan data task baru ke dalam database
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'points' => $request->points,
            'deadline' => $request->deadline,
        ]);


        // Redirect ke halaman index tasks dengan pesan sukses
        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully');
    }
}
