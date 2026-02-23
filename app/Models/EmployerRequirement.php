<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerRequirement extends Model
{
    protected $table = 'employer_requirements';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_required' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
