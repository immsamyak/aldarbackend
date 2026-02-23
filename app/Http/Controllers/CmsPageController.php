<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\CmsPage;
use Illuminate\Http\JsonResponse;

class CmsPageController extends CrudController
{
    protected function model(): string { return CmsPage::class; }
    protected function searchableFields(): array { return ['title_en', 'title_ne', 'slug']; }

    public function getBySlug(string $slug): JsonResponse
    {
        $page = CmsPage::where('slug', $slug)->first();
        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }
        return response()->json(PublicMapper::mapPage($page));
    }
}
