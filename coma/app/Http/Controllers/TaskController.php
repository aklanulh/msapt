<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Submission;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Update expired tasks before displaying
        Task::updateExpiredTasks();
        
        $sortBy = $request->get('sort', 'newest'); // Default sort by newest
        
        $query = Task::query();
        
        // Apply sorting based on the sort parameter
        switch ($sortBy) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'deadline_asc':
                $query->orderBy('deadline', 'asc');
                break;
            case 'deadline_desc':
                $query->orderBy('deadline', 'desc');
                break;
            case 'points_high':
                $query->orderBy('points', 'desc');
                break;
            case 'points_low':
                $query->orderBy('points', 'asc');
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'category':
                $query->orderBy('category', 'asc')->orderBy('title', 'asc');
                break;
            case 'status':
                $query->orderBy('status', 'asc')->orderBy('deadline', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $tasks = $query->get();
        $favoriteTasks = collect();
        
        if (Auth::check()) {
            $favoriteTasks = Task::whereHas('favorites', function($query) {
                $query->where('user_id', Auth::id());
            })->get();
        }
        
        return view('tasks.index', compact('tasks', 'favoriteTasks', 'sortBy'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        
        // Check and update if this specific task is expired
        $task->checkAndUpdateExpiredStatus();
        $isFavorited = false;
        $userSubmission = null;
        
        if (Auth::check()) {
            $isFavorited = Favorite::where('user_id', Auth::id())
                                 ->where('task_id', $id)
                                 ->exists();
            
            $userSubmission = Submission::where('user_id', Auth::id())
                                       ->where('task_id', $id)
                                       ->first();
        }
        
        return view('tasks.show', compact('task', 'isFavorited', 'userSubmission'));
    }

    public function submitTask(Request $request, $id)
    {
        $request->validate([
            'submission_url' => 'nullable|url',
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        // Validate that at least one of URL or screenshot is provided
        if (empty($request->submission_url) && !$request->hasFile('screenshot')) {
            return back()->withErrors([
                'submission' => 'Silakan isi URL submission atau upload screenshot sebagai bukti pengerjaan.'
            ])->withInput();
        }

        $task = Task::findOrFail($id);
        
        // Check if user already submitted
        $existingSubmission = Submission::where('user_id', Auth::id())
                                       ->where('task_id', $id)
                                       ->first();
        
        if ($existingSubmission) {
            return back()->with('error', 'Anda sudah mengirim submission untuk tugas ini.');
        }

        $screenshotPath = null;
        if ($request->hasFile('screenshot')) {
            $screenshotPath = $request->file('screenshot')->store('screenshots', 'public');
        }

        Submission::create([
            'user_id' => Auth::id(),
            'task_id' => $id,
            'submission_url' => $request->submission_url,
            'screenshot_path' => $screenshotPath,
            'status' => 'pending',
            'submitted_at' => now()
        ]);

        return back()->with('success', 'Submission berhasil dikirim! Tunggu review dari admin.');
    }

    public function updateSubmission(Request $request, $id)
    {
        $request->validate([
            'submission_url' => 'nullable|url',
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        // Find existing submission first to check current screenshot
        $submission = Submission::where('user_id', Auth::id())
                                ->where('task_id', $id)
                                ->first();
        
        if (!$submission) {
            return back()->with('error', 'Submission tidak ditemukan.');
        }
        
        // Validate that at least one of URL or screenshot is provided
        // (either new upload or existing screenshot)
        if (empty($request->submission_url) && !$request->hasFile('screenshot') && !$submission->screenshot_path) {
            return back()->withErrors([
                'submission' => 'Silakan isi URL submission atau upload screenshot sebagai bukti pengerjaan.'
            ])->withInput();
        }

        $task = Task::findOrFail($id);

        // Only allow update if status is pending
        if ($submission->status !== 'pending') {
            return back()->with('error', 'Submission yang sudah direview tidak dapat diubah.');
        }

        $updateData = [
            'submission_url' => $request->submission_url,
            'submitted_at' => now()
        ];

        // Handle screenshot upload
        if ($request->hasFile('screenshot')) {
            // Delete old screenshot if exists
            if ($submission->screenshot_path && \Storage::disk('public')->exists($submission->screenshot_path)) {
                \Storage::disk('public')->delete($submission->screenshot_path);
            }
            
            $updateData['screenshot_path'] = $request->file('screenshot')->store('screenshots', 'public');
        }

        $submission->update($updateData);

        return back()->with('success', 'Submission berhasil diperbarui!');
    }

    public function favorites()
    {
        $favoriteTasks = Task::whereHas('favorites', function($query) {
            $query->where('user_id', Auth::id());
        })->get();
        
        return view('tasks.favorites', compact('favoriteTasks'));
    }

    public function toggleFavorite($id)
    {
        $task = Task::findOrFail($id);
        
        $favorite = Favorite::where('user_id', Auth::id())
                           ->where('task_id', $id)
                           ->first();
        
        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Tugas dihapus dari favorit.');
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'task_id' => $id
            ]);
            return back()->with('success', 'Tugas ditambahkan ke favorit.');
        }
    }
}
