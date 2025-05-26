<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $table = 'campaign';

    protected $fillable = [
        'id',
      'title',
      'description',
      'category',
      'target_amount',
      'contact_email',
      'image',
    ];


    public function donation()
    {
        return $this->hasMany(Donation::class);
    }

    public function getRaisedAmountAttribute()
    {
        return $this->donation()->sum('amount');
    }

    public function getProgressAttribute()
    {
        $raised = $this->raised_amount;
        return $this->target_amount
            ? round( ($raised / $this->target_amount) * 100, 2 )
            : 0;
    }
}

