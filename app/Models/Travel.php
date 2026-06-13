<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travels';

    protected $fillable = [
        'asal',
        'tujuan',
        'jam_berangkat',
        'harga',
        'jumlah_kursi',
        'kelas',
        'aktif'
    ];

    public function bookings()
    {
        return $this->hasMany(TravelBooking::class);
    }
}