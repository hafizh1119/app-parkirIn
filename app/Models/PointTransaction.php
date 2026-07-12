<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    use HasFactory;

    protected $table = 'point_transactions';

    protected $fillable = [
        'user_id',
        'reservasi_id',
        'points',
        'type',
        'description'
    ];

    protected $casts = [
        'points' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }

    public function scopeEarn($query)
    {
        return $query->where('type', 'earn');
    }

    public function scopeRedeem($query)
    {
        return $query->where('type', 'redeem');
    }

    public function scopeBonus($query)
    {
        return $query->where('type', 'bonus');
    }

    protected static function booted()
    {
        static::created(function ($transaction) {
            self::syncUserTotalPoints($transaction->user_id);
        });

        static::deleted(function ($transaction) {
            self::syncUserTotalPoints($transaction->user_id);
        });
    }

    protected static function syncUserTotalPoints($userId)
    {
        $total = self::where('user_id', $userId)->sum('points');

        User::where('id', $userId)->update([
            'total_points' => $total,
        ]);
    }
}