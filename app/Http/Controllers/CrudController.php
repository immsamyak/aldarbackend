<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class CrudController extends Controller
{
    abstract protected function model(): string;

    // ── Key conversion helpers ──────────────────────────────────
    // Express Mongoose uses camelCase fields with _en/_ne locale suffixes.
    // Laravel MySQL uses snake_case for everything.
    // These helpers convert between the two conventions.

    public static function snakeToCamel(string $key): string
    {
        // Preserve _en / _ne locale suffixes
        $suffix = '';
        if (preg_match('/_(en|ne)$/', $key, $m)) {
            $suffix = '_' . $m[1];
            $key = substr($key, 0, -strlen($suffix));
        }
        return lcfirst(str_replace('_', '', ucwords($key, '_'))) . $suffix;
    }

    public static function camelToSnake(string $key): string
    {
        // Preserve _en / _ne locale suffixes
        $suffix = '';
        if (preg_match('/_(en|ne)$/', $key, $m)) {
            $suffix = '_' . $m[1];
            $key = substr($key, 0, -strlen($suffix));
        }
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key)) . $suffix;
    }

    /**
     * Convert Eloquent model (or array) to Express-compatible format:
     * - id → _id (string)
     * - snake_case keys → camelCase (preserving _en/_ne suffixes)
     */
    /**
     * Reverse FK aliases: DB column names → camelCase output names.
     * e.g. form_id → formId (via snakeToCamel) — already handled.
     * But we also need the raw relation name for backward compat.
     */
    public static function formatItem($item): array
    {
        $data = ($item instanceof Model) ? $item->toArray() : (array) $item;

        $result = [];
        if (isset($data['id'])) {
            $result['_id'] = (string) $data['id'];
        }

        foreach ($data as $key => $value) {
            if ($key === 'id') continue;
            $result[self::snakeToCamel($key)] = $value;
        }

        return $result;
    }

    /**
     * Convert a collection of models to Express-compatible format.
     */
    public static function formatList($items): array
    {
        return $items->map(fn ($item) => self::formatItem($item))->values()->toArray();
    }

    /**
     * FK field aliases: bare relation names → actual DB column names.
     * In Express/Mongoose, "form" holds an ObjectId ref.
     * In Laravel/MySQL, the column is "form_id".
     */
    private static array $fieldAliases = [
        'form'   => 'form_id',
        'job'    => 'job_id',
        'user'   => 'user_id',
        'role'   => 'role_id',
        'parent' => 'parent_id',
    ];

    /**
     * Convert incoming camelCase request keys to snake_case for DB,
     * and map bare relation names (form, job, etc.) to their _id columns.
     */
    public function parseInput(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $snakeKey = self::camelToSnake($key);
            // Map bare relation names → FK columns
            if (isset(self::$fieldAliases[$snakeKey])) {
                $snakeKey = self::$fieldAliases[$snakeKey];
            }
            $result[$snakeKey] = $value;
        }
        return $result;
    }

    // ── CRUD methods ────────────────────────────────────────────

    public function list(Request $request): JsonResponse
    {
        $items = $this->model()::orderBy('created_at', 'desc')->get();
        return response()->json($this->formatList($items));
    }

    public function getById(string $id): JsonResponse
    {
        $item = $this->model()::find($id);
        if (!$item) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        return response()->json($this->formatItem($item));
    }

    public function create(Request $request): JsonResponse
    {
        $item = $this->model()::create($this->parseInput($request->all()));
        return response()->json($this->formatItem($item), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $item = $this->model()::find($id);
        if (!$item) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        $item->update($this->parseInput($request->all()));
        return response()->json($this->formatItem($item->fresh()));
    }

    public function remove(string $id): JsonResponse
    {
        $item = $this->model()::find($id);
        if (!$item) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        $formatted = $this->formatItem($item);
        $item->delete();
        return response()->json($formatted);
    }

    /**
     * Generic reorder: accepts { items: [{ _id, order }], orderField: 'displayOrder' }
     * Converts the camelCase orderField to snake_case for the DB column.
     */
    public function reorder(Request $request): JsonResponse
    {
        $items = $request->input('items', []);
        $orderField = $request->input('orderField', 'display_order');

        // Convert camelCase to snake_case for DB column
        $column = self::camelToSnake($orderField);

        $modelClass = $this->model();

        foreach ($items as $item) {
            $id = $item['_id'] ?? $item['id'] ?? null;
            $order = $item['order'] ?? null;
            if ($id !== null && $order !== null) {
                $modelClass::where('id', $id)->update([$column => $order]);
            }
        }

        return response()->json(['message' => 'Reorder successful']);
    }

    protected function searchableFields(): array
    {
        return [];
    }
}
