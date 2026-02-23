<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationController extends CrudController
{
    protected function model(): string { return Application::class; }
    protected function searchableFields(): array { return ['full_name', 'email']; }

    public function list(Request $request): JsonResponse
    {
        $items = Application::with(['job:id,title_en,country,status', 'user:id,full_name,email'])
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json(self::formatList($items));
    }
}
