<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\PageSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageSectionController extends CrudController
{
    protected function model(): string { return PageSection::class; }
    protected function searchableFields(): array { return ['page_slug', 'section_key', 'title_en', 'title_ne']; }

    /**
     * Public endpoint: get all active sections for a page slug.
     */
    public function listByPageSlug(string $slug): JsonResponse
    {
        $sections = PageSection::where('page_slug', $slug)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json(
            $sections->map(fn ($s) => PublicMapper::mapPageSection($s))->values()->toArray()
        );
    }

    /**
     * Reorder sections: accepts { items: [{ id, sort_order }] }
     */
    public function reorder(Request $request): JsonResponse
    {
        $items = $request->input('items', []);

        foreach ($items as $item) {
            PageSection::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['message' => 'Reorder successful']);
    }
}
