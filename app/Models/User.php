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
}

