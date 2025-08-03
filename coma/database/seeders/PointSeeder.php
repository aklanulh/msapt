<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Point;
use App\Models\User;
use App\Models\Task;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user (or create one if none exists)
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@coma.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'total_points' => 0,
                'total_money' => 0,
            ]);
        }

        // Sample point transactions with adjusted realistic values
        $pointTransactions = [
            [
                'user_id' => $user->id,
                'task_id' => null,
                'submission_id' => null,
                'points_earned' => 50,
                'points_type' => 'earned',
                'description' => 'Instagram Post Campaign - Fashion Brand',
                'status' => 'approved',
                'created_at' => now()->subDays(7),
            ],
            [
                'user_id' => $user->id,
                'task_id' => null,
                'submission_id' => null,
                'points_earned' => 75,
                'points_type' => 'earned',
                'description' => 'TikTok Video Campaign - Food Review',
                'status' => 'approved',
                'created_at' => now()->subDays(5),
            ],
            [
                'user_id' => $user->id,
                'task_id' => null,
                'submission_id' => null,
                'points_earned' => 60,
                'points_type' => 'earned',
                'description' => 'YouTube Shorts - Tech Product Review',
                'status' => 'approved',
                'created_at' => now()->subDays(3),
            ],
            [
                'user_id' => $user->id,
                'task_id' => null,
                'submission_id' => null,
                'points_earned' => 40,
                'points_type' => 'earned',
                'description' => 'Twitter Thread - Travel Experience',
                'status' => 'pending',
                'created_at' => now()->subDays(1),
            ],
            [
                'user_id' => $user->id,
                'task_id' => null,
                'submission_id' => null,
                'points_earned' => 25,
                'points_type' => 'bonus',
                'description' => 'Referral Bonus - New User Registration',
                'status' => 'approved',
                'created_at' => now()->subDays(2),
            ],
            [
                'user_id' => $user->id,
                'task_id' => null,
                'submission_id' => null,
                'points_earned' => -100,
                'points_type' => 'withdrawn',
                'description' => 'Withdrawal request #1',
                'status' => 'approved',
                'created_at' => now()->subDays(4),
            ],
            [
                'user_id' => $user->id,
                'task_id' => null,
                'submission_id' => null,
                'points_earned' => 45,
                'points_type' => 'earned',
                'description' => 'Facebook Story Campaign - Beauty Product',
                'status' => 'approved',
                'created_at' => now()->subHours(6),
            ],
            [
                'user_id' => $user->id,
                'task_id' => null,
                'submission_id' => null,
                'points_earned' => 80,
                'points_type' => 'earned',
                'description' => 'Instagram Reels - Lifestyle Content',
                'status' => 'approved',
                'created_at' => now()->subHours(12),
            ],
            [
                'user_id' => $user->id,
                'task_id' => null,
                'submission_id' => null,
                'points_earned' => 30,
                'points_type' => 'earned',
                'description' => 'Facebook Post - Product Review',
                'status' => 'approved',
                'created_at' => now()->subDays(6),
            ],
            [
                'user_id' => $user->id,
                'task_id' => null,
                'submission_id' => null,
                'points_earned' => 35,
                'points_type' => 'earned',
                'description' => 'Twitter Post - Brand Awareness',
                'status' => 'approved',
                'created_at' => now()->subDays(8),
            ],
        ];

        // Create point records
        foreach ($pointTransactions as $transaction) {
            Point::create($transaction);
        }

        // Calculate and update user's total points and money
        $totalApprovedPoints = Point::where('user_id', $user->id)
            ->where('status', 'approved')
            ->sum('points_earned');

        $user->update([
            'total_points' => max(0, $totalApprovedPoints), // Ensure it's not negative
            'total_money' => max(0, $totalApprovedPoints) * 1000, // 1 point = Rp 1,000
        ]);

        $this->command->info('Point seeder completed successfully!');
        $this->command->info("User '{$user->name}' now has {$user->total_points} points (Rp " . number_format($user->total_money) . ")");
    }
}
