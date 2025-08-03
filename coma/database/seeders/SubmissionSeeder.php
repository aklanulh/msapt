<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Submission;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada user dan task yang tersedia
        $users = User::all();
        $tasks = Task::all();
        
        if ($users->isEmpty() || $tasks->isEmpty()) {
            $this->command->warn('Users atau Tasks tidak ditemukan. Pastikan UserSeeder dan TaskSeeder sudah dijalankan.');
            return;
        }

        // Submission dengan status PENDING
        Submission::create([
            'user_id' => $users->first()->id,
            'task_id' => $tasks->where('title', 'Review Produk Skincare')->first()->id ?? $tasks->first()->id,
            'submission_url' => 'https://instagram.com/p/sample-review-post',
            'screenshot_path' => 'submissions/review-skincare-screenshot.jpg',
            'notes' => 'Review produk skincare sudah selesai, mohon dicek.',
            'status' => 'pending',
            'submitted_at' => Carbon::now()->subHours(2),
            'created_at' => Carbon::now()->subHours(2),
            'updated_at' => Carbon::now()->subHours(2)
        ]);

        // Submission dengan status APPROVED
        Submission::create([
            'user_id' => $users->first()->id,
            'task_id' => $tasks->where('title', 'Share Post Instagram')->first()->id ?? $tasks->skip(1)->first()->id,
            'submission_url' => 'https://instagram.com/stories/username/sample-story',
            'screenshot_path' => 'submissions/instagram-story-proof.jpg',
            'notes' => 'Story Instagram sudah dipost dengan mention brand dan hashtag yang benar.',
            'status' => 'approved',
            'submitted_at' => Carbon::now()->subDays(1),
            'created_at' => Carbon::now()->subDays(1),
            'updated_at' => Carbon::now()->subHours(12)
        ]);

        // Submission dengan status REJECTED
        Submission::create([
            'user_id' => $users->first()->id,
            'task_id' => $tasks->where('title', 'Like dan Comment Post')->first()->id ?? $tasks->skip(2)->first()->id,
            'submission_url' => 'https://instagram.com/p/sample-comment',
            'screenshot_path' => 'submissions/comment-proof-incomplete.jpg',
            'notes' => 'Screenshot bukti like dan comment pada 5 post terakhir.',
            'status' => 'rejected',
            'submitted_at' => Carbon::now()->subDays(2),
            'created_at' => Carbon::now()->subDays(2),
            'updated_at' => Carbon::now()->subDays(1)
        ]);

        // Submission untuk user kedua (jika ada)
        if ($users->count() > 1) {
            Submission::create([
                'user_id' => $users->skip(1)->first()->id,
                'task_id' => $tasks->where('title', 'Survey Konsumen')->first()->id ?? $tasks->skip(3)->first()->id,
                'submission_url' => 'https://forms.google.com/survey-response/abc123',
                'screenshot_path' => null, // Survey tidak perlu screenshot
                'notes' => 'Survey konsumen sudah diisi dengan lengkap.',
                'status' => 'pending',
                'submitted_at' => Carbon::now()->subMinutes(30),
                'created_at' => Carbon::now()->subMinutes(30),
                'updated_at' => Carbon::now()->subMinutes(30)
            ]);

            Submission::create([
                'user_id' => $users->skip(1)->first()->id,
                'task_id' => $tasks->where('title', 'Video Testimoni Produk')->first()->id ?? $tasks->skip(4)->first()->id,
                'submission_url' => 'https://youtube.com/watch?v=sample-testimoni',
                'screenshot_path' => 'submissions/testimoni-video-thumbnail.jpg',
                'notes' => 'Video testimoni produk dengan durasi 45 detik, kualitas HD.',
                'status' => 'approved',
                'submitted_at' => Carbon::now()->subDays(3),
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(2)
            ]);
        }

        // Submission untuk testing task
        Submission::create([
            'user_id' => $users->first()->id,
            'task_id' => $tasks->where('title', 'Testing Task Expired')->first()->id ?? $tasks->last()->id,
            'submission_url' => 'https://example.com/testing-submission',
            'screenshot_path' => 'submissions/testing-screenshot.png',
            'notes' => 'Testing submission untuk task yang sudah expired.',
            'status' => 'pending',
            'submitted_at' => Carbon::now()->subHours(6),
            'created_at' => Carbon::now()->subHours(6),
            'updated_at' => Carbon::now()->subHours(6)
        ]);

        // Submission dengan berbagai waktu untuk testing
        Submission::create([
            'user_id' => $users->first()->id,
            'task_id' => $tasks->where('title', 'Testing Task Deadline Dekat')->first()->id ?? $tasks->first()->id,
            'submission_url' => 'https://example.com/urgent-task-submission',
            'screenshot_path' => 'submissions/urgent-task-photo.jpg',
            'notes' => 'Submission untuk task dengan deadline dekat.',
            'status' => 'rejected',
            'submitted_at' => Carbon::now()->subHours(1),
            'created_at' => Carbon::now()->subHours(1),
            'updated_at' => Carbon::now()->subMinutes(30)
        ]);

        $this->command->info('Submission seeder berhasil dijalankan dengan ' . Submission::count() . ' submissions.');
    }
}
