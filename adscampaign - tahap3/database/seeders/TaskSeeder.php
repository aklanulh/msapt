<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat beberapa tasks
        Task::create([
            'title' => 'Task 1',
            'description' => 'Description for task 1',
            'points' => 10,
            'deadline' => Carbon::now()->addDays(7),
        ]);

        Task::create([
            'title' => 'Task 2',
            'description' => 'Description for task 2',
            'points' => 20,
            'deadline' => Carbon::now()->addDays(10),
        ]);

        Task::create([
            'title' => 'Task 3',
            'description' => 'Description for task 3',
            'points' => 15,
            'deadline' => Carbon::now()->addDays(5),
        ]);
    }
}
