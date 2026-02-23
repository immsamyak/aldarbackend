<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountryController extends CrudController
{
    protected function model(): string { return Country::class; }
    protected function searchableFields(): array { return ['name_en', 'name_ne']; }

    public function listPublic(): JsonResponse
    {
        $items = Country::where('is_active', true)->orderBy('name_en', 'asc')->get();
        return response()->json($items->map(fn($c) => PublicMapper::mapCountry($c))->values());
    }

    public function getBySlugPublic(string $slug): JsonResponse
    {
        $item = Country::where('slug', $slug)->where('is_active', true)->first();
        if (!$item) {
            return response()->json(['message' => 'Country not found'], 404);
        }
        return response()->json(PublicMapper::mapCountry($item));
    }

    public function getBySlug(string $slug): JsonResponse
    {
        $item = Country::where('slug', $slug)->first();
        if (!$item) {
            return response()->json(['message' => 'Country not found'], 404);
        }
        return response()->json(self::formatItem($item));
    }

    public function create(Request $request): JsonResponse
    {
        $data = $this->parseInput($request->all());
        if (!empty($data['name_en']) && empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name_en']);
        }
        $item = Country::create($data);
        return response()->json(self::formatItem($item), 201);
    }
}
