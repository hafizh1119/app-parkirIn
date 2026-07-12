<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $table = 'memberships';

    protected $fillable = [
        'user_id',
        'tier',
        'total_points',
        'redeemed_points',
        'available_points',
        'join_date',
        'expiry_date',
        'is_active'
    ];

    protected $casts = [
        'join_date' => 'date',
        'expiry_date' => 'date',
        'is_active' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(PointTransaction::class, 'user_id', 'user_id');
    }

    public function getTierLabelAttribute()
    {
        $tiers = [
            'basic' => ['label' => 'Basic', 'class' => 'bg-gray-100 text-gray-600'],
            'premium' => ['label' => 'Premium', 'class' => 'bg-blue-100 text-blue-600'],
            'gold' => ['label' => 'Gold', 'class' => 'bg-yellow-100 text-yellow-600']
        ];
        return $tiers[$this->tier] ?? $tiers['basic'];
    }

    public function getStatusBadgeAttribute()
    {
        if ($this->is_active) {
            return ['label' => 'Aktif', 'class' => 'bg-green-100 text-green-600'];
        }
        return ['label' => 'Tidak Aktif', 'class' => 'bg-gray-100 text-gray-600'];
    }

    public function addPoints($points, $description = null)
    {
        $this->total_points += $points;
        $this->available_points += $points;
        $this->save();

        PointTransaction::create([
            'user_id' => $this->user_id,
            'points' => $points,
            'type' => 'earn',
            'description' => $description
        ]);

        return $this;
    }

    public function redeemPoints($points, $description = null)
    {
        if ($this->available_points < $points) {
            throw new \Exception('Poin tidak mencukupi');
        }

        $this->redeemed_points += $points;
        $this->available_points -= $points;
        $this->save();

        PointTransaction::create([
            'user_id' => $this->user_id,
            'points' => -$points,
            'type' => 'redeem',
            'description' => $description
        ]);

        return $this;
    }

    public function upgradeTier($newTier)
    {
        $this->tier = $newTier;
        $this->save();
        return $this;
    }

    public function hasEnoughPoints($points)
    {
        return $this->available_points >= $points;
    }

    public function pembayaranMembership()
    {
        return $this->hasMany(PembayaranMembership::class);
    }
    
    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class, 'user_id', 'user_id');
    }
}