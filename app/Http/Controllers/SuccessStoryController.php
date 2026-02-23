<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\SuccessStory;
use Illuminate\Http\JsonResponse;

class SuccessStoryController extends CrudController
{
    protected function model(): string { return SuccessStory::class; }
    protected function searchableFields(): array { return ['candidate_name']; }

    public function listPublicOrAll(\Illuminate\Http\Request $request): JsonResponse
    {
        if ($request->query('all') === 'true') {
            $items = SuccessStory::orderBy('order_index', 'asc')->get();
            return response()->json(self::formatList($items));
        }
        $items = SuccessStory::where('is_active', true)->orderBy('order_index', 'asc')->get();
        return response()->json($items->map(fn($s) => PublicMapper::mapSuccessStory($s))->values());
    }
}
