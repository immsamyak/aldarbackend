<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    protected $table = 'users';

    protected $fillable = [
        'full_name', 'email', 'phone', 'password_hash', 'role_id', 'is_active', 'last_login_at',
    ];

    protected $hidden = ['password_hash'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    // JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role?->name ?? 'staff',
        ];
    }

    // Laravel auth uses 'password' by default; map to our column
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'uploaded_by');
    }
}
