<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Notice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoticeController extends CrudController
{
    protected function model(): string { return Notice::class; }
    protected function searchableFields(): array { return ['title_en', 'title_ne']; }

    public function listPublished(): JsonResponse
    {
        $notices = Notice::where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('is_popup')
                  ->orWhere('is_popup', false);
            })
            ->orderBy('publish_date', 'desc')
            ->get();

        return response()->json($notices->map(fn($n) => PublicMapper::mapNotice($n))->values());
    }

    public function listActivePopups(Request $request): JsonResponse
    {
        $page = $request->query('page', 'home');

        $notices = Notice::where('is_published', true)
            ->where('is_popup', true)
            ->where(function ($q) {
                $q->whereNull('schedule_date')
                  ->orWhere('schedule_date', '<=', now());
            })
            ->get()
            ->filter(function ($n) use ($page) {
                $targets = $n->target_pages ?? [];
                if (empty($targets)) return true;
                return in_array($page, $targets) || in_array('all', $targets);
            });

        return response()->json($notices->values()->map(fn($n) => PublicMapper::mapNotice($n))->values());
    }

    public function create(Request $request): JsonResponse
    {
        $data = $this->parseInput($request->all());
        $data = $this->normalizeNoticeData($data);
        $item = Notice::create($data);
        return response()->json(self::formatItem($item), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $item = Notice::find($id);
        $data = $this->normalizeNoticeData($this->parseInput($request->all()));

        if (!$item) {
            // Upsert fallback
            $item = Notice::create($data);
            return response()->json(self::formatItem($item), 201);
        }

        $item->update($data);
        return response()->json(self::formatItem($item->fresh()));
    }

    private function normalizeNoticeData(array $data): array
    {
        if (!empty($data['is_popup'])) {
            if (empty($data['schedule_date'])) {
                $data['schedule_date'] = now();
            }
            if (empty($data['target_pages'])) {
                $data['target_pages'] = ['home'];
            }
        } else {
            $data['schedule_date'] = null;
            $data['target_pages'] = null;
            $data['image_url'] = $data['image_url'] ?? '';
            $data['pdf_url'] = $data['pdf_url'] ?? '';
        }

        // Ensure NOT NULL string columns never receive null
        // (ConvertEmptyStringsToNull middleware can turn "" → null)
        foreach (['attachment_url', 'image_url', 'pdf_url'] as $field) {
            if (array_key_exists($field, $data) && $data[$field] === null) {
                $data[$field] = '';
            }
        }

        return $data;
    }
}
