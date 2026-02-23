<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends CrudController
{
    protected function model(): string { return Menu::class; }

    public function listPublic(): JsonResponse
    {
        $menus = Menu::where('is_enabled', true)
            ->orderBy('location', 'asc')
            ->orderBy('order_index', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($menus->map(fn($m) => PublicMapper::mapMenu($m))->values());
    }

    public function listAll(Request $request): JsonResponse
    {
        if ($request->query('all') === 'true') {
            $menus = Menu::orderBy('location', 'asc')->orderBy('order_index', 'asc')->get();
            return response()->json(self::formatList($menus));
        }
        return $this->listPublic();
    }

    public function create(Request $request): JsonResponse
    {
        $data = $this->parseInput($request->all());
        if (isset($data['order_index'])) {
            $data['order_index'] = (int) $data['order_index'];
        }
        $item = Menu::create($data);
        return response()->json(self::formatItem($item), 201);
    }
}
