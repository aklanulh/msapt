<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class UpdateExpiredTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:update-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update task status to expired for tasks that have passed their deadline';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired tasks...');
        
        $updatedCount = Task::updateExpiredTasks();
        
        if ($updatedCount > 0) {
            $this->info("Updated {$updatedCount} expired task(s).");
        } else {
            $this->info('No expired tasks found.');
        }
        
        return 0;
    }
}
