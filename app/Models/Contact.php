<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'email_sent',
        'whatsapp_sent',
        'read_at'
    ];

    protected $casts = [
        'email_sent' => 'boolean',
        'whatsapp_sent' => 'boolean',
        'read_at' => 'datetime',
    ];

    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }

    public function isRead()
    {
        return !is_null($this->read_at);
    }
}
