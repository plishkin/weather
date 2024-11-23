<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $primaryKey = 'increments';

    protected $fillable = [
        'timestamp_dt',
        'city_name',
        'min_tmp',
        'max_tmp',
        'wind_spd'
    ];

    protected function casts(): array
    {
        return [
            'timestamp_dt' => 'datetime',
        ];
    }

    protected $visible = [
        'updated_at',
        'timestamp_dt',
        'city_name',
        'min_tmp',
        'max_tmp',
        'wind_spd'
    ];

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->getTimestamp();
    }

}
