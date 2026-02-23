<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\SiteService;
use Illuminate\Http\JsonResponse;

class SiteServiceController extends CrudController
{
    protected function model(): string { return SiteService::class; }
    protected function searchableFields(): array { return ['title_en', 'title_ne']; }

    public function listPublicOrAll(\Illuminate\Http\Request $request): JsonResponse
    {
        if ($request->query('all') === 'true') {
            $items = SiteService::orderBy('order_index', 'asc')->get();
            return response()->json(self::formatList($items));
        }
        $items = SiteService::where('is_active', true)->orderBy('order_index', 'asc')->get();
        return response()->json($items->map(fn($s) => PublicMapper::mapService($s))->values());
    }
}
