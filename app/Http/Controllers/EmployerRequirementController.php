<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\EmployerRequirement;
use Illuminate\Http\JsonResponse;

class EmployerRequirementController extends CrudController
{
    protected function model(): string { return EmployerRequirement::class; }
    protected function searchableFields(): array { return ['document_name_en', 'document_name_ne']; }

    public function listPublic(): JsonResponse
    {
        $items = EmployerRequirement::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->get();
        return response()->json($items->map(fn($r) => PublicMapper::mapEmployerRequirement($r))->values());
    }
}
