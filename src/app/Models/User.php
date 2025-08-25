<?php

namespace Taskio\UserManagement\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'mobile',
        'password',
        'first_name',
        'last_name',
        'avatar',
        'socket_id',
        'banned_at',
        'activated_at',
        'email_verified_at',
        'last_logged_in_at'
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
