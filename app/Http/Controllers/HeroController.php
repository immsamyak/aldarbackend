<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Hero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HeroController extends CrudController
{
    protected function model(): string { return Hero::class; }

    public function getPublic(): JsonResponse
    {
        $hero = Hero::first();
        if (!$hero) {
            return response()->json(PublicMapper::mapHero(null));
        }
        return response()->json(PublicMapper::mapHero($hero));
    }

    public function updatePublic(Request $request): JsonResponse
    {
        $data = $request->all();

        // Normalize counters
        if (isset($data['counters']) && is_array($data['counters'])) {
            $data['counters'] = array_values(array_filter($data['counters'], function ($c) {
                return !empty($c['key']) && !empty($c['label_en']) && !empty($c['label_ne']);
            }));
            foreach ($data['counters'] as &$counter) {
                $counter['value'] = (int) ($counter['value'] ?? 0);
                $counter['key'] = trim($counter['key']);
                $counter['label_en'] = trim($counter['label_en']);
                $counter['label_ne'] = trim($counter['label_ne']);
            }
        }

        $hero = Hero::first();
        if (!$hero) {
            $hero = Hero::create($data);
        } else {
            $hero->update($data);
        }
        return response()->json(self::formatItem($hero->fresh()));
    }
}
