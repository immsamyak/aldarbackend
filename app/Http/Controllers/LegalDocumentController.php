<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\LegalDocument;
use Illuminate\Http\JsonResponse;

class LegalDocumentController extends CrudController
{
    protected function model(): string { return LegalDocument::class; }
    protected function searchableFields(): array { return ['title_en', 'title_ne']; }

    public function listPublic(): JsonResponse
    {
        $items = LegalDocument::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->get();
        return response()->json($items->map(fn($d) => PublicMapper::mapLegalDocument($d))->values());
    }
}
