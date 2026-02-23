<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\RecruitmentProcess;
use Illuminate\Http\JsonResponse;

class RecruitmentProcessController extends CrudController
{
    protected function model(): string { return RecruitmentProcess::class; }
    protected function searchableFields(): array { return ['title_en', 'title_ne']; }

    public function listPublic(): JsonResponse
    {
        $items = RecruitmentProcess::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->get();
        return response()->json($items->map(fn($r) => PublicMapper::mapRecruitmentProcess($r))->values());
    }
}
