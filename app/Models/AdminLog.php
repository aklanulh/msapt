<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AdminLog extends Model
{
    protected $fillable = [
        'action',
        'entity_type',
        'entity_id',
        'entity_name',
        'description',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Log admin activity
     */
    public static function logActivity($action, $description, $entityType = null, $entityId = null, $entityName = null, $oldValues = null, $newValues = null)
    {
        return self::create([
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'entity_name' => $entityName,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent()
        ]);
    }

    /**
     * Get formatted action badge
     */
    public function getActionBadgeAttribute()
    {
        $badges = [
            'login' => 'bg-success',
            'logout' => 'bg-secondary',
            'create' => 'bg-primary',
            'update' => 'bg-warning',
            'delete' => 'bg-danger',
            'view' => 'bg-info'
        ];

        return $badges[$this->action] ?? 'bg-secondary';
    }

    /**
     * Get formatted action text
     */
    public function getActionTextAttribute()
    {
        $texts = [
            'login' => 'Login',
            'logout' => 'Logout',
            'create' => 'Tambah',
            'update' => 'Edit',
            'delete' => 'Hapus',
            'view' => 'Lihat'
        ];

        return $texts[$this->action] ?? ucfirst($this->action);
    }

    /**
     * Scope for recent logs
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope for specific action
     */
    public function scopeAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope for specific entity
     */
    public function scopeEntity($query, $entityType, $entityId = null)
    {
        $query = $query->where('entity_type', $entityType);
        
        if ($entityId) {
            $query->where('entity_id', $entityId);
        }
        
        return $query;
    }
}
