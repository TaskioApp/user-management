<?php

namespace Taskio\UserManagement\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Taskio\UserManagement\Interfaces\RepositoryInterface;
use Taskio\UserManagement\Models\User;

class UserManagementRepository implements RepositoryInterface
{
    public function index(array $params): LengthAwarePaginator
    {
        return User::latest()->paginate();
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
}
