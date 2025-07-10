<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns'; // Changed to plural for Laravel convention

    protected $fillable = [
        'id',
        'title',
        'description',
        'category',
        'target_amount',
        'contact_email',
        'image',
        'user_id',
        'start_date',  // Added important campaign dates
        'end_date',    // Added important campaign dates
        'is_featured', // Added for highlighting campaigns
        'status'       // Added for better campaign management
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'target_amount' => 'float',
        'is_featured' => 'boolean',
    ];

    protected $appends = [
        'raised_amount',
        'progress',
        'days_remaining',
        'is_active'
    ];

    // Relationships
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getRaisedAmountAttribute()
    {
        return $this->donations()->where('payment_status', 'completed')->sum('amount');
    }

    public function getProgressAttribute()
    {
        if ($this->target_amount <= 0) return 0;
        return min(100, round(($this->raised_amount / $this->target_amount) * 100, 2));
    }

    public function getDaysRemainingAttribute()
    {
        if (!$this->end_date) return null;
        return now()->diffInDays($this->end_date, false);
    }

    public function getIsActiveAttribute()
    {
        if (!$this->start_date || !$this->end_date) return false;
        return now()->between($this->start_date, $this->end_date);
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? asset('storage/campaigns/'.$this->image) : asset('images/default-campaign.jpg')
        );
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where(function($q) {
            $q->where('start_date', '<=', now())
              ->where('end_date', '>=', now());
        });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeWithTargetReached($query)
    {
        return $query->whereRaw('(SELECT COALESCE(SUM(amount), 0) FROM donations WHERE donations.campaign_id = campaigns.id AND donations.payment_status = "completed") >= campaigns.target_amount');
    }

    // Helpers
    public function markAsFeatured()
    {
        $this->update(['is_featured' => true]);
    }

    public function removeFeatured()
    {
        $this->update(['is_featured' => false]);
    }

    public function updateStatus()
    {
        $status = 'draft';

        if ($this->start_date && $this->end_date) {
            if ($this->is_active) {
                $status = 'active';
            } elseif (now()->lt($this->start_date)) {
                $status = 'upcoming';
            } else {
                $status = 'completed';
            }
        }

        $this->update(['status' => $status]);
    }
}
