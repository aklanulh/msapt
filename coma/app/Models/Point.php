<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Point extends Model
{
    protected $fillable = [
        'user_id',
        'task_id',
        'submission_id',
        'points_earned',
        'points_type', // earned, withdrawn, bonus
        'description',
        'status' // pending, approved, rejected
    ];

    protected $casts = [
        'points_earned' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    /**
     * Get total points for a user
     */
    public static function getTotalPointsForUser($userId): int
    {
        return self::where('user_id', $userId)
                   ->where('status', 'approved')
                   ->where('points_type', 'earned')
                   ->sum('points_earned');
    }
}
