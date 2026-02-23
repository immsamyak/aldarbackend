<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Upload a file to public storage.
     * Accepts multipart/form-data with a "file" field.
     * Optional "folder" field to organize uploads (default: "uploads").
     *
     * Returns { url, path, filename } where url is the full public URL.
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'folder' => 'nullable|string|max:100',
        ]);

        $file = $request->file('file');
        $folder = $request->input('folder', 'uploads');

        // Sanitize folder name
        $folder = preg_replace('/[^a-zA-Z0-9_\-\/]/', '', $folder);

        // Generate unique filename
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($originalName) . '-' . time() . '.' . $extension;

        // Store in public disk (storage/app/public/{folder})
        $path = $file->storeAs($folder, $safeName, 'public');

        // Full URL: APP_URL/storage/{folder}/{filename}
        $url = asset('storage/' . $path);

        return response()->json([
            'url' => $url,
            'path' => 'storage/' . $path,
            'filename' => $safeName,
        ]);
    }

    /**
     * Delete a previously uploaded file.
     */
    public function delete(Request $request): JsonResponse
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        $path = $request->input('path');

        // Strip "storage/" prefix if present
        $storagePath = preg_replace('/^storage\//', '', $path);

        if (Storage::disk('public')->exists($storagePath)) {
            Storage::disk('public')->delete($storagePath);
            return response()->json(['message' => 'File deleted']);
        }

        return response()->json(['message' => 'File not found'], 404);
    }
}
