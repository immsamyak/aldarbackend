<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'phone_numbers' => 'array',
            'emails' => 'array',
            'social_links' => 'array',
            'objectives_en' => 'array',
            'objectives_ne' => 'array',
            'whatsapp_enabled' => 'boolean',
        ];
    }
}
