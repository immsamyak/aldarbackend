<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotData extends Model
{
    protected $table = 'chatbot_data';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
