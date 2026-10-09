<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VesselSchedule extends Model
{
    protected $fillable = [
        'kapal',
        'voy',
        'closing',
        'etd_sub',
        'is_full',
    ];

    protected $casts = [
        'closing' => 'datetime',
        'etd_sub' => 'date',
        'is_full' => 'boolean',
    ];
}
