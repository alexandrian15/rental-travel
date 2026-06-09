<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'car_id',
        'nama_pemesan',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_harga',
    ];
public function car()
{
    return $this->belongsTo(Car::class);
    
}
}