<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Translation;
use Illuminate\Http\JsonResponse;

class TranslationController extends CrudController
{
    protected function model(): string { return Translation::class; }
    protected function searchableFields(): array { return ['namespace', 'key']; }

    public function listPublic(): JsonResponse
    {
        $items = Translation::all();
        return response()->json($items->map(fn($t) => PublicMapper::mapTranslation($t))->values());
    }
}
