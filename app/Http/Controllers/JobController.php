<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Country;
use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function create(Request $request): JsonResponse
    {
        $data = $this->normalizeJobData($this->parseInput($request->all()));
        $item = Job::create($data);

        return response()->json(self::formatItem($item), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $item = Job::find($id);
        if (!$item) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        $data = $this->normalizeJobData($this->parseInput($request->all()), $item);
        $item->update($data);

        return response()->json(self::formatItem($item->fresh()));
    }

    private function normalizeJobData(array $data, ?Job $existing = null): array
    {
        if (array_key_exists('category', $data)) {
            $data['category'] = $this->resolveJobCategory($data['category']);
        }

        if (array_key_exists('country', $data)) {
            $data['country'] = $this->resolveCountry($data['country']);
        }

        if (array_key_exists('salary_min', $data)) {
            $data['salary_min'] = (int) ($data['salary_min'] ?? 0);
        }

        if (array_key_exists('salary_max', $data)) {
            $data['salary_max'] = (int) ($data['salary_max'] ?? 0);
        }

        if (array_key_exists('is_featured', $data)) {
            $data['is_featured'] = (bool) $data['is_featured'];
        }

        $slugSeed = '';
        if (!empty($data['slug'])) {
            $slugSeed = (string) $data['slug'];
        } elseif (!empty($data['title_en'])) {
            $slugSeed = (string) $data['title_en'];
        } elseif ($existing && !empty($existing->title_en)) {
            $slugSeed = (string) $existing->title_en;
        }

        if ($slugSeed !== '') {
            $data['slug'] = $this->generateUniqueSlug($slugSeed, $existing?->id);
        }

        return $data;
    }

    private function generateUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value);
        if ($base === '') {
            $base = 'job';
        }

        $slug = $base;
        $counter = 2;
        while (
            Job::query()
                ->when($ignoreId !== null, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function resolveCountry(mixed $value): string
    {
        if (is_array($value)) {
            return (string) ($value['name_en'] ?? $value['name'] ?? $value['slug'] ?? '');
        }

        $raw = trim((string) $value);
        if ($raw === '') {
            return '';
        }

        if (!ctype_digit($raw)) {
            return $raw;
        }

        $country = Country::find((int) $raw);
        if (!$country) {
            return $raw;
        }

        return (string) ($country->name_en ?: $country->name_ne ?: $country->slug ?: $raw);
    }

    private function resolveJobCategory(mixed $value): string
    {
        if (is_array($value)) {
            return (string) ($value['name_en'] ?? $value['name'] ?? $value['slug'] ?? '');
        }

        $raw = trim((string) $value);
        if ($raw === '') {
            return '';
        }

        if (!ctype_digit($raw)) {
            return $raw;
        }

        $category = JobCategory::find((int) $raw);
        if (!$category) {
            return $raw;
        }

        return (string) ($category->name_en ?: $category->name_ne ?: $category->slug ?: $raw);
    }
}
