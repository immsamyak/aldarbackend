<?php

namespace App\Http\Controllers;

use App\Helpers\PublicMapper;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends CrudController
{
    protected function model(): string { return Brand::class; }

    public function list(Request $request): JsonResponse
    {
        $brand = Brand::first();
        if (!$brand) {
            return response()->json([]);
        }
        return response()->json([self::formatItem($brand)]);
    }

    public function getPublic(): JsonResponse
    {
        $brand = Brand::first();
        if (!$brand) {
            // Return defaults
            return response()->json(PublicMapper::mapBrand(null));
        }
        return response()->json(PublicMapper::mapBrand($brand));
    }

    public function updatePublic(Request $request): JsonResponse
    {
        $data = $this->parseInput($request->all());
        $brand = Brand::first();
        if (!$brand) {
            $brand = Brand::create($data);
        } else {
            $brand->update($data);
        }
        return response()->json(self::formatItem($brand->fresh()));
    }
}
