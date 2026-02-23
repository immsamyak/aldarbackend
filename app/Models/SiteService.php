<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteService extends Model
{
    protected $table = 'services';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
