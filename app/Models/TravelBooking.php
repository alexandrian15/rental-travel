<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelBooking extends Model
{
    protected $fillable = [
        'travel_id',
        'user_id',
        'nama_pemesan',
        'telepon',
        'tanggal_berangkat',
        'jumlah_penumpang',
        'total_harga',
        'status'
    ];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}