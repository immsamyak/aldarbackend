<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'form_submissions';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'files' => 'array',
        ];
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
