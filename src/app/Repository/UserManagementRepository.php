<?php

namespace Taskio\UserManagement\Repository;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Taskio\UserManagement\Interfaces\RepositoryInterface;
use Taskio\UserManagement\Models\User;

class UserManagementRepository implements RepositoryInterface
{
    public function index(array $params): LengthAwarePaginator
    {
        return User::latest()->search($params)->paginate();
    }

    public function get(int $id): User
    {
        return User::findOrFail($id);
    }

    public function store(array $params): User
    {
        return User::query()->create($params);
    }

    public function update(array $params, int $id): int
    {
        return User::where('id', $id)->update($params);
    }

    public function destroy(int $id): bool
    {
        return User::where('id', $id)->delete();
    }

    public function ban(int $id): int
    {

        return User::where('id', $id)->update(['banned_at' => Carbon::now()]);
    }

    public function unban(int $id)
    {
        User::where('id', $id)->update(['banned_at' => null]);
    }

    public function getByUsername(string $username)
    {
        return User::where('username', $username)->orWhere('email', $username)->orWhere('mobile', $username)->first();
    }
}
