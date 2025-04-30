<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'description',
      'target_amount',
    ];


    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function getRaisedAmountAttribute()
    {
        return $this->donations()->sum('amount');
    }

    public function getProgressAttribute()
    {
        $raised = $this->raised_amount;
        return $this->target_amount
            ? round( ($raised / $this->target_amount) * 100, 2 )
            : 0;
    }
}

