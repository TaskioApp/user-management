<?php

namespace Taskio\UserManagement\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Taskio\UserManagement\Events\UserCreated;
use Taskio\UserManagement\Listeners\SendEmailNotification;

class UserManagementEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        UserCreated::class => [
            SendEmailNotification::class
        ]
    ];
}
