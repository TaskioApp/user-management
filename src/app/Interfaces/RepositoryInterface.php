<?php

namespace Taskio\UserManagement\Interfaces;

interface RepositoryInterface
{
    public function index(array $request);
    public function get(int $id);
    public function store(array $request);
    public function update(array $request, int $id);
    public function destroy(int $id);
    public function ban(int $id);
    public function unban(int $id);
    public function getByUsername(string $username);
    public function checkValidOtp(object $user, string $code): bool;
    public function storeOtp(object $user, string $code);
    public function useOtp(object $user, string $code);
    public function getValidOtp(object $user);
}
