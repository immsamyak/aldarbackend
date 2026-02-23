<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $guarded = ['id'];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
