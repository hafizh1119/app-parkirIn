<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipTier extends Model
{
    use HasFactory;

    protected $table = 'membership_tiers';

    protected $fillable = [
        'name',
        'slug',
        'min_points',
        'max_points',
        'discount_percentage',
        'point_multiplier',
        'benefits',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'benefits' => 'array',
    ];

    public function getBenefitsArrayAttribute()
    {
        return $this->benefits ? json_decode($this->benefits, true) : [];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function getTierByPoints($points)
    {
        return self::where('min_points', '<=', $points)
                   ->where(function ($query) use ($points) {
                       $query->where('max_points', '>=', $points)
                             ->orWhereNull('max_points');
                   })
                   ->first();
    }
}