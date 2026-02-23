<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Form;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends CrudController
{
    protected function model(): string { return Form::class; }
    protected function searchableFields(): array { return ['name', 'slug']; }

    public function getPublicBySlug(string $slug): JsonResponse
    {
        $form = Form::where('slug', $slug)->where('is_active', true)->first();
        if (!$form) {
            return response()->json(['message' => 'Form not found'], 404);
        }
        return response()->json(PublicMapper::mapForm($form));
    }

    public function getBySlug(string $slug): JsonResponse
    {
        $form = Form::where('slug', $slug)->first();
        if (!$form) {
            return response()->json(['message' => 'Form not found'], 404);
        }
        return response()->json(self::formatItem($form));
    }

    public function create(Request $request): JsonResponse
    {
        $data = $this->parseInput($request->all());
        if (!empty($data['name']) && empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        $item = Form::create($data);
        return response()->json(self::formatItem($item), 201);
    }
}
