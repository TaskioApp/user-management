<?php

namespace Taskio\UserManagement\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Taskio\UserManagement\Models\User;

class UserCreated
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public readonly User $user)
    {
        
    }
}
