<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'demand_sectors_en' => 'array',
            'demand_sectors_ne' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
