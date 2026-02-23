<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalDocument extends Model
{
    protected $table = 'legal_documents';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'expiry_date' => 'date',
            'is_active' => 'boolean',
        ];
    }
}
