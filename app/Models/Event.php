<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'discount_percentage',
        'image',
        'start_date',
        'end_date',
        'status',
        'max_capacity',
        'current_participants',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            $event->slug = Str::slug($event->name);
        });
    }

    // Relasi many-to-many ke LokasiParkir
    public function lokasiParkirs()
    {
        return $this->belongsToMany(LokasiParkir::class, 'event_lokasi_parkir');
    }

    //  Scope untuk event aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    //  Scope filter by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    //  Update status otomatis berdasarkan tanggal
    public function updateStatus()
    {
        $now = now();
        
        if ($now < $this->start_date) {
            $this->status = 'upcoming';
        } elseif ($now >= $this->start_date && $now <= $this->end_date) {
            $this->status = 'active';
        } else {
            $this->status = 'completed';
        }
        $this->save();
        return $this;
    }

    //  Status badge untuk tampilan
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'upcoming' => ['label' => 'Akan Datang', 'class' => 'bg-blue-100 text-blue-700'],
            'active' => ['label' => 'Aktif', 'class' => 'bg-green-100 text-green-700'],
            'completed' => ['label' => 'Selesai', 'class' => 'bg-gray-100 text-gray-700'],
            'waiting' => ['label' => 'Menunggu', 'class' => 'bg-yellow-100 text-yellow-700']
        ];

        return $badges[$this->status] ?? $badges['waiting'];
    }

    //  Format tanggal untuk tampilan
    public function getFormattedDateAttribute()
    {
        return [
            'start' => $this->start_date->format('d M Y'),
            'start_time' => $this->start_date->format('H:i'),
            'end' => $this->end_date->format('d M Y'),
            'end_time' => $this->end_date->format('H:i'),
            'full' => $this->start_date->format('d M Y H:i') . ' - ' . $this->end_date->format('d M Y H:i')
        ];
    }

    //  URL gambar
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/events/' . $this->image);
        }
        return null;
    }

    //  Nama lokasi parkir digabung
    public function getLokasiNamesAttribute()
    {
        return $this->lokasiParkirs->pluck('nama')->implode(', ');
    }

    //  Jumlah lokasi parkir terhubung
    public function getLokasiCountAttribute()
    {
        return $this->lokasiParkirs->count();
    }

    //  TAMBAHKAN METHOD untuk cek diskon
    public function hasDiscount()
    {
         return $this->discount_percentage > 0 && $this->is_active;
    }

     //  TAMBAHKAN METHOD untuk format diskon
    public function getDiscountLabelAttribute()
    {
        if ($this->discount_percentage > 0) {
                return $this->discount_percentage . '%';
            }
         return 'Tidak ada diskon';
    }
}