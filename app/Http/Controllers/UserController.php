<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends CrudController
{
    protected function model(): string { return User::class; }
    protected function searchableFields(): array { return ['full_name', 'email']; }

    public function list(Request $request): JsonResponse
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $result = $users->map(fn($user) => $this->formatUser($user))->values()->toArray();
        return response()->json($result);
    }

    public function getById(string $id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($this->formatUser($user));
    }

    public function create(Request $request): JsonResponse
    {
        $data = $request->all();

        // Check email uniqueness
        $email = strtolower($data['email'] ?? '');
        if (User::where('email', $email)->exists()) {
            return response()->json(['message' => 'Email already exists'], 409);
        }

        // Resolve role name to ID
        if (!empty($data['role']) && !is_numeric($data['role'])) {
            $role = Role::where('name', $data['role'])->first();
            $data['role_id'] = $role?->id;
        } else {
            $data['role_id'] = $data['role'] ?? null;
        }
        unset($data['role']);

        $data['email'] = $email;
        $data['password_hash'] = Hash::make($data['password'] ?? 'ChangeMe123!');
        unset($data['password']);

        $user = User::create($data);
        return response()->json($this->formatUser($user), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $data = $request->all();

        // Resolve role name to ID
        if (!empty($data['role']) && !is_numeric($data['role'])) {
            $role = Role::where('name', $data['role'])->first();
            $data['role_id'] = $role?->id;
        } elseif (isset($data['role'])) {
            $data['role_id'] = $data['role'];
        }
        unset($data['role']);

        if (!empty($data['password'])) {
            $data['password_hash'] = Hash::make($data['password']);
            unset($data['password']);
        }

        $user->update($data);
        return response()->json($this->formatUser($user));
    }

    public function remove(string $id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $formatted = $this->formatUser($user);
        $user->delete();
        return response()->json($formatted);
    }

    private function formatUser(User $user): array
    {
        $data = self::formatItem($user);
        unset($data['passwordHash']);
        unset($data['roleId']);

        if ($user->role_id) {
            $role = Role::find($user->role_id);
            $data['role'] = $role?->name ?? null;
        }

        return $data;
    }
}
