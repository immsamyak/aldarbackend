<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends CrudController
{
    protected function model(): string { return Category::class; }
    protected function searchableFields(): array { return ['name_en', 'name_ne']; }

    public function listPublic(): JsonResponse
    {
        $items = Category::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->get();
        return response()->json($items->map(fn($c) => PublicMapper::mapCategory($c))->values());
    }
}
