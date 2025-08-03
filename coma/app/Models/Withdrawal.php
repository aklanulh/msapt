<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'points_amount',
        'money_amount',
        'payment_method',
        'payment_details',
        'status',
        'processed_at',
        'notes'
    ];

    protected $casts = [
        'points_amount' => 'integer',
        'money_amount' => 'integer',
        'payment_details' => 'array',
        'processed_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted money amount
     */
    public function getFormattedMoneyAttribute(): string
    {
        return 'Rp ' . number_format($this->money_amount);
    }

    /**
     * Get payment details as readable string
     */
    public function getPaymentDetailsStringAttribute(): string
    {
        $details = $this->payment_details;
        
        if ($this->payment_method === 'bank_transfer') {
            return "{$details['bank_name']} - {$details['account_number']} ({$details['account_holder']})";
        } elseif ($this->payment_method === 'e_wallet') {
            return "{$details['ewallet_type']} - {$details['ewallet_number']}";
        }
        
        return 'Unknown payment method';
    }
}
