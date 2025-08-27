<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserManagementsTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique()->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('mobile', 20)->unique()->nullable();
            $table->string('password')->nullable();

            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('avatar', 100)->nullable();
            $table->string('socket_id', 100)->nullable();

            $table->timestamp('banned_at')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_logged_in_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
