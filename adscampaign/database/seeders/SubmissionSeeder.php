<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Submission;
use Carbon\Carbon;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $submissions = [
            ['user_id' => 2, 'task_id' => 1, 'submission_url' => 'https://example.com/submission21', 'status' => 'pending'],
            ['user_id' => 2, 'task_id' => 2, 'submission_url' => 'https://example.com/submission22', 'status' => 'approve'],
            ['user_id' => 2, 'task_id' => 3, 'submission_url' => 'https://example.com/submission23', 'status' => 'reject'],
            ['user_id' => 3, 'task_id' => 1, 'submission_url' => 'https://example.com/submission31', 'status' => 'pending'],
            ['user_id' => 3, 'task_id' => 2, 'submission_url' => 'https://example.com/submission32', 'status' => 'approve'],
            ['user_id' => 3, 'task_id' => 3, 'submission_url' => 'https://example.com/submission33', 'status' => 'reject'],
            ['user_id' => 4, 'task_id' => 1, 'submission_url' => 'https://example.com/submission41', 'status' => 'pending'],
            ['user_id' => 4, 'task_id' => 2, 'submission_url' => 'https://example.com/submission42', 'status' => 'approve'],
            ['user_id' => 4, 'task_id' => 3, 'submission_url' => 'https://example.com/submission43', 'status' => 'reject'],
            ['user_id' => 5, 'task_id' => 1, 'submission_url' => 'https://example.com/submission51', 'status' => 'pending'],
            ['user_id' => 5, 'task_id' => 2, 'submission_url' => 'https://example.com/submission52', 'status' => 'approve'],
            ['user_id' => 5, 'task_id' => 3, 'submission_url' => 'https://example.com/submission53', 'status' => 'reject'],
            ['user_id' => 6, 'task_id' => 1, 'submission_url' => 'https://example.com/submission61', 'status' => 'pending'],
            ['user_id' => 6, 'task_id' => 2, 'submission_url' => 'https://example.com/submission62', 'status' => 'approve'],
            ['user_id' => 6, 'task_id' => 3, 'submission_url' => 'https://example.com/submission63', 'status' => 'reject'],
        ];

        foreach ($submissions as $submission) {
            Submission::create($submission);
        }
    }
}
