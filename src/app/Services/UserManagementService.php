<?php

namespace Taskio\UserManagement\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Taskio\FileUploader\Services\FileUploaderService;
use Taskio\UserManagement\Interfaces\RepositoryInterface;
use Taskio\UserManagement\Models\User;
use Throwable;

class UserManagementService
{

    public function __construct(public readonly RepositoryInterface $repository, public readonly FileUploaderService $fileUploader) {}

    public function index(array $params): LengthAwarePaginator
    {
        return $this->repository->index($params);
    }

    public function get(int $id): User
    {
        return $this->repository->get($id);
    }

    public function store(array $params): User
    {
        DB::beginTransaction();
        try {
            if (!empty($params['avatar'])) {
                $params['avatar'] = $this->fileUploader->setFolder('avatars')->upload($params['avatar'])->path;
            }
            DB::commit();
            return $this->repository->store($params);
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    public function update(array $params, int $id): User
    {
        $user = $this->repository->get($id);


        DB::beginTransaction();
        try {
            if (!empty($params['avatar'])) {

                if (!empty($user->avatar)) {
                    $this->fileUploader->delete($user->avatar);
                }

                $params['avatar'] = $this->fileUploader->setFolder('avatars')->upload($params['avatar'])->path;
            }

            $this->repository->update($params, $user->id);

            DB::commit();

            return $this->repository->get($id);
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }

    public function destroy(int $id): User
    {
        DB::beginTransaction();
        try {
            $user = $this->repository->get($id);

            $this->repository->destroy($user->id);
            DB::commit();
            return $user;
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }

    public function toggleBan(int $id): User
    {
        DB::beginTransaction();
        try {
            $user = $this->repository->get($id);

            if (empty($user->banned_at)) {
                $this->repository->ban($user->id);
            } else {
                $this->repository->unban($user->id);
            }

            DB::commit();
            return $this->repository->get($id);
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }
}
