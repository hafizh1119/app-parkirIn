<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointSetting extends Model
{
    use HasFactory;

    protected $table = 'point_settings';

    protected $fillable = [
        'points_per_rupiah',
        'min_transaction',
        'redeem_points'
    ];

    protected $casts = [
        'points_per_rupiah' => 'integer',
        'min_transaction' => 'integer',
        'redeem_points' => 'integer',
    ];

    public static function getSettings()
    {
        return self::first() ?? self::create([
            'points_per_rupiah' => 10,
            'min_transaction' => 10000,
            'redeem_points' => 6000
        ]);
    }

    public static function updateSettings($data)
    {
        $settings = self::getSettings();
        $settings->update($data);
        return $settings;
    }

    public function calculatePoints($amount)
    {
        return floor($amount / $this->points_per_rupiah);
    }

    public function calculateDiscount($points)
    {
        return $points * $this->points_per_rupiah;
    }
}