<?php

namespace Taskio\UserManagement\Listeners;

use Taskio\UserManagement\Events\UserCreated;

class SendEmailNotification
{

    public function handle(UserCreated $event): void
    {
        $user = $event->user;

        //


    }
}
