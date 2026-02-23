<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\OrganizationStructure;
use Illuminate\Http\JsonResponse;

class OrganizationStructureController extends CrudController
{
    protected function model(): string { return OrganizationStructure::class; }
    protected function searchableFields(): array { return ['name', 'designation_en']; }

    public function listPublic(): JsonResponse
    {
        $items = OrganizationStructure::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->get();
        return response()->json($items->map(fn($o) => PublicMapper::mapOrganizationStructure($o))->values());
    }
}
