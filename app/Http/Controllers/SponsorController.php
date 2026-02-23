<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Sponsor;
use Illuminate\Http\JsonResponse;

class SponsorController extends CrudController
{
    protected function model(): string { return Sponsor::class; }
    protected function searchableFields(): array { return ['name']; }

    public function listPublic(): JsonResponse
    {
        $sponsors = Sponsor::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return response()->json($sponsors->map(fn($s) => PublicMapper::mapSponsor($s))->values());
    }
}
