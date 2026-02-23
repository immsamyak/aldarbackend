<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationStructure extends Model
{
    protected $table = 'organization_structure';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
