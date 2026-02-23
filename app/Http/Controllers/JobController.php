<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends CrudController
{
    protected function model(): string { return Job::class; }
    protected function searchableFields(): array { return ['title_en', 'title_ne', 'category', 'country']; }

    public function listPublic(Request $request): JsonResponse
    {
        $query = Job::where('status', 'open');

        if ($cat = $request->query('category')) {
            $query->where('category', $cat);
        }
        if ($country = $request->query('country')) {
            $query->where('country', $country);
        }
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title_en', 'LIKE', "%{$search}%")
                  ->orWhere('title_ne', 'LIKE', "%{$search}%");
            });
        }

        $jobs = $query->orderBy('created_at', 'desc')->get();

        return response()->json($jobs->map(fn($j) => PublicMapper::mapJob($j))->values());
    }

    public function getBySlug(string $slug): JsonResponse
    {
        $job = Job::where('slug', $slug)->first();
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }
        return response()->json(PublicMapper::mapJob($job));
    }
}
