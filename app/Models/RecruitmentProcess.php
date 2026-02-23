<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruitmentProcess extends Model
{
    protected $table = 'recruitment_process';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
