<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class RequireRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user->load('role');
        $userRole = $user->role?->name;

        if (!in_array($userRole, $roles)) {
            return response()->json(['message' => 'Forbidden: insufficient role'], 403);
        }

        return $next($request);
    }
}
