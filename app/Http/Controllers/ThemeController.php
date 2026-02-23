<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Theme;
use Illuminate\Http\JsonResponse;

class ThemeController extends CrudController
{
    protected function model(): string { return Theme::class; }

    public function getPublic(): JsonResponse
    {
        $theme = Theme::where('is_default', true)->first();
        if (!$theme) {
            $theme = Theme::first();
        }
        if (!$theme) {
            return response()->json(null);
        }
        return response()->json(PublicMapper::mapTheme($theme));
    }
}
