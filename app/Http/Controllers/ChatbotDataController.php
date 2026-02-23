<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\ChatbotData;
use Illuminate\Http\JsonResponse;

class ChatbotDataController extends CrudController
{
    protected function model(): string { return ChatbotData::class; }
    protected function searchableFields(): array { return ['category', 'question_en', 'question_ne']; }

    public function listPublic(): JsonResponse
    {
        $items = ChatbotData::where('is_active', true)->get();
        return response()->json($items->map(fn($c) => PublicMapper::mapChatbot($c))->values());
    }

    public function listByCategory(string $category): JsonResponse
    {
        $items = ChatbotData::where('category', $category)->where('is_active', true)->get();
        return response()->json($items->map(fn($c) => PublicMapper::mapChatbot($c))->values());
    }
}
