<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranMembership extends Model
{
    protected $table = 'pembayaran_membership';

    protected $fillable = [
        'membership_id',
        'user_id',
        'order_id',
        'snap_token',
        'transaction_id',
        'payment_type',
        'transaction_status',
        'gross_amount',
        'status',
        'paid_at',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}