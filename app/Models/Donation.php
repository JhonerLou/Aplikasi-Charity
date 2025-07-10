<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $table = 'donation';

    protected $fillable = [
        'user_id',
        'campaign_id',
        'amount',
        'message',
        'donor_name',
        'donor_email',
        'is_anonymous',
        'payment_status',
        'paid_at',
        'bank_name',           // Add this
        'account_number',      // Add this
        'account_holder_name'
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'paid_at' => 'datetime',
    ];

    protected $attributes = [
        'payment_status' => 'pending',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('payment_status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    // Helpers
    public function markAsPaid()
    {
        $this->update([
            'payment_status' => 'completed',
            'paid_at' => now(),
        ]);
    }

    public function isPaid()
    {
        return $this->payment_status === 'completed';
    }

    public function getDonorNameAttribute()
    {
        return $this->is_anonymous ? 'Anonymous' : $this->attributes['donor_name'];
    }
}
