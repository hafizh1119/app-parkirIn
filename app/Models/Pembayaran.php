<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'reservasi_id',
        'order_id',
        'snap_token',
        'transaction_id',
        'payment_type',
        'transaction_status',
        'gross_amount',
        'status',
        'paid_at',
        'selected_payment_method',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
}