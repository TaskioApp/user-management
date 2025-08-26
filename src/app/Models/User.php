<?php

namespace Taskio\UserManagement\Models;

use Dom\Attr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, SoftDeletes, HasApiTokens;

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
        'password'
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

    public function scopeSearch(Builder $builder, array $params): Builder
    {
        $username = $params['username'] ?? null;
        $email = $params['email'] ?? null;
        $mobile = $params['mobile'] ?? null;
        $firstName = $params['first_name'] ?? null;
        $lastName = $params['last_name'] ?? null;
        $withTrashed = $params['with_trashed'] ?? null;

        $builder->when($username, fn(Builder $builder, $value) => $builder->where('username', $value));
        $builder->when($email, fn(Builder $builder, $value) => $builder->where('email', $value));
        $builder->when($mobile, fn(Builder $builder, $value) => $builder->where('mobile', $value));
        $builder->when($firstName, fn(Builder $builder, $value) => $builder->where('first_name', 'like', "%$value%"));
        $builder->when($lastName, fn(Builder $builder, $value) => $builder->where('last_name', 'like', "%$value%"));
        $builder->when($withTrashed, fn(Builder $builder, $value) => $builder->withTrashed());

        return $builder;
    }

    public function isActive() {}

    public function isBan() {}
}
