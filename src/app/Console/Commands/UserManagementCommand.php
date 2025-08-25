<?php

namespace Taskio\UserManagement\Console\Commands;

use Illuminate\Console\Command;

class UserManagementCommand extends Command
{
    protected $signature = 'taskio:user_management';
    protected $description = 'Command for UserManagement module';
    public function handle()
    {
        $this->info('UserManagement executed successfully.');
    }
}
