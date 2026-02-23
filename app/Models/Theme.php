<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'themes';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['is_default' => 'boolean'];
    }
}
