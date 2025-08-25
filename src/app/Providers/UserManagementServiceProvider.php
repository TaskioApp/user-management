<?php

namespace Taskio\UserManagement\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Taskio\UserManagement\Http\Controllers\UserManagementController;
use Taskio\UserManagement\Interfaces\RepositoryInterface;
use Taskio\UserManagement\Repository\UserManagementRepository;

class UserManagementServiceProvider extends ServiceProvider
{
    private string $namespace = 'Taskio\UserManagement\Http\Controllers';

    public function register()
    {
        $this->app->singleton(RepositoryInterface::class, UserManagementRepository::class);

        $this->app->register(UserManagementEventServiceProvider::class);
    }

    public function boot()
    {
        $this->defineRoutes();
    }

    private function defineRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->controller(UserManagementController::class)
            ->group(__DIR__ . '../../../routes/api.php');
    }
}
