<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'positions' => 'array',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            if (empty($category->slug) && !empty($category->name_en)) {
                $category->slug = \Illuminate\Support\Str::slug($category->name_en);
            }
        });
    }
}
