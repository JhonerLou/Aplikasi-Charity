<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id'
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    // Relationships
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    // Helpers
    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
        ]);
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
