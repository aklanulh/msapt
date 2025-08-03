<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'points',
        'deadline',
        'category',
        'status',
        'requirements'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'requirements' => 'array'
    ];

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    /**
     * Check if task is expired and update status accordingly
     */
    public function checkAndUpdateExpiredStatus(): bool
    {
        if ($this->deadline && $this->deadline < now() && $this->status === 'available') {
            $this->update(['status' => 'expired']);
            return true;
        }
        return false;
    }

    /**
     * Update all expired tasks in the database
     */
    public static function updateExpiredTasks(): int
    {
        return self::where('deadline', '<', now())
                   ->where('status', 'available')
                   ->update(['status' => 'expired']);
    }

    /**
     * Scope to get only available (non-expired) tasks
     */
    public function scopeAvailable($query)
    {
        return $query->where(function($q) {
            $q->where('status', 'available')
              ->where(function($subq) {
                  $subq->whereNull('deadline')
                       ->orWhere('deadline', '>=', now());
              });
        });
    }

    /**
     * Scope to get expired tasks
     */
    public function scopeExpired($query)
    {
        return $query->where('deadline', '<', now())
                     ->orWhere('status', 'expired');
    }
}
