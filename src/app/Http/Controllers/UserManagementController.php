<?php

namespace Taskio\UserManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Taskio\UserManagement\Http\Requests\UserManagementStoreRequest;
use Taskio\UserManagement\Http\Requests\UserManagementUpdateRequest;
use Taskio\UserManagement\Http\Resources\UserManagementResource;
use Taskio\UserManagement\Services\UserManagementService;

class UserManagementController extends Controller
{
    public function __construct(public readonly UserManagementService $userManagementService) {}

    public function index(Request $request)
    {
        $users = $this->userManagementService->index($request->all());

        return UserManagementResource::collection($users);
    }

    public function get(int $id)
    {
        $user = $this->userManagementService->get($id);

        return new UserManagementResource($user);
    }

    public function store(UserManagementStoreRequest $request)
    {
        $user = $this->userManagementService->store($request->validated());

        return new UserManagementResource($user);
    }

    public function update(UserManagementUpdateRequest $request, int $id)
    {
        $user = $this->userManagementService->update($request->validated(), $id);

        return new UserManagementResource($user);
    }

    public function destroy(int $id)
    {
        $user = $this->userManagementService->destroy($id);

        return new UserManagementResource($user);
    }

    public function toggleBan(int $id)
    {
        $user = $this->userManagementService->toggleBan($id);

        return new UserManagementResource($user);
    }
}
