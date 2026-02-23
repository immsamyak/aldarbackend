<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobCategoryController extends CrudController
{
    protected function model(): string { return JobCategory::class; }
    protected function searchableFields(): array { return ['name_en', 'name_ne']; }

    public function listPublic(): JsonResponse
    {
        $items = JobCategory::where('is_active', true)
            ->orderBy('order_index', 'asc')
            ->get(['id', 'name_en', 'name_ne', 'slug', 'icon', 'order_index']);

        return response()->json(self::formatList($items));
    }

    public function create(Request $request): JsonResponse
    {
        $data = $this->parseInput($request->all());
        if (!empty($data['name_en']) && empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name_en']);
        }
        if (isset($data['order_index'])) {
            $data['order_index'] = (int) $data['order_index'];
        }
        $item = JobCategory::create($data);
        return response()->json(self::formatItem($item), 201);
    }
}
