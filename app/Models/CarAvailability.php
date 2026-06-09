<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarAvailability extends Model
{
    protected $fillable = [
        'car_id',
        'tanggal',
        'unit_terpakai'
    ];
}