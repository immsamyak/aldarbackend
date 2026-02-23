<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Gallery;
use Illuminate\Http\JsonResponse;

class GalleryController extends CrudController
{
    protected function model(): string { return Gallery::class; }
    protected function searchableFields(): array { return ['title_en', 'title_ne']; }

    public function listPublicOrAll(\Illuminate\Http\Request $request): JsonResponse
    {
        if ($request->query('all') === 'true') {
            $items = Gallery::orderBy('order_index', 'asc')->get();
            return response()->json(self::formatList($items));
        }
        $items = Gallery::where('is_active', true)->orderBy('order_index', 'asc')->get();
        return response()->json($items->map(fn($g) => PublicMapper::mapGallery($g))->values());
    }
}
