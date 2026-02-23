<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notices';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'is_popup' => 'boolean',
            'target_pages' => 'array',
            'publish_date' => 'datetime',
            'schedule_date' => 'datetime',
        ];
    }
}
