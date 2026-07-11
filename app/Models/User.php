<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nomor_hp',
        'status_member',
        'total_points',
        'status_akun',
        'foto_profil'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class);
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }

    public function membership()
    {
        return $this->hasOne(Membership::class);
    }

    public function pembayaranMembership()
    {
        return $this->hasMany(PembayaranMembership::class);
    }
    
    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class);
    }

    public function getTotalPointAttribute()
    {
        return $this->pointTransactions()->sum('points');
    }
}

