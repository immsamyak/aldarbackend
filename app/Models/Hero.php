<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $table = 'hero';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'counters' => 'array',
            'show_counters' => 'boolean',
        ];
    }
}
