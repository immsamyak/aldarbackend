<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;

class TestimonialController extends CrudController
{
    protected function model(): string { return Testimonial::class; }
    protected function searchableFields(): array { return ['candidate_name']; }

    public function listPublicOrAll(\Illuminate\Http\Request $request): JsonResponse
    {
        if ($request->query('all') === 'true') {
            $items = Testimonial::orderBy('order_index', 'asc')->get();
            return response()->json(self::formatList($items));
        }
        $items = Testimonial::where('is_active', true)->orderBy('order_index', 'asc')->get();
        return response()->json($items->map(fn($t) => PublicMapper::mapTestimonial($t))->values());
    }
}
