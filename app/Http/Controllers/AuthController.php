<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'fullName' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string',
            'role' => 'nullable|in:super_admin,admin,staff,recruiter',
        ]);

        $roleName = $request->input('role', 'staff');
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 400);
        }

        $user = User::create([
            'full_name' => $request->input('fullName'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone', ''),
            'password_hash' => Hash::make($request->input('password')),
            'role_id' => $role->id,
            'is_active' => true,
        ]);

        $token = JWTAuth::fromUser($user);
        $refreshToken = JWTAuth::claims(['type' => 'refresh'])->fromUser($user);

        return response()->json([
            'accessToken' => $token,
            'refreshToken' => $refreshToken,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password_hash)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user->load('role');
        $roleName = $user->role?->name ?? 'staff';

        $token = JWTAuth::fromUser($user);
        $refreshToken = JWTAuth::claims(['type' => 'refresh'])->fromUser($user);

        return response()->json([
            'user' => [
                '_id' => (string) $user->id,
                'fullName' => $user->full_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'role' => $roleName,
            ],
            'accessToken' => $token,
            'refreshToken' => $refreshToken,
        ]);
    }

    public function refresh(Request $request): JsonResponse
    {
        $request->validate([
            'refreshToken' => 'required|string|min:10',
        ]);

        try {
            JWTAuth::setToken($request->input('refreshToken'));
            $user = JWTAuth::authenticate();

            if (!$user) {
                return response()->json(['message' => 'Invalid token'], 401);
            }

            $token = JWTAuth::fromUser($user);
            $refreshToken = JWTAuth::claims(['type' => 'refresh'])->fromUser($user);

            return response()->json([
                'accessToken' => $token,
                'refreshToken' => $refreshToken,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid or expired refresh token'], 401);
        }
    }

    public function me(): JsonResponse
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user->load('role');

        return response()->json([
            '_id' => (string) $user->id,
            'fullName' => $user->full_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'role' => $user->role?->name ?? 'staff',
            'isActive' => $user->is_active,
        ]);
    }
}
