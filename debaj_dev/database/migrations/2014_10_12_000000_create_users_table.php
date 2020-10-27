<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('type')
                ->comment('0 => user, 1=> vendor without plan,
                 2 => vendor waiting for activating plan, 3 => with active plan');
            $table->string('username');
            $table->string('phone');
            $table->string('password');
            $table->string('lng')->nullable();
            $table->string('lat')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('reset_password_code')->nullable();
            $table->string('code_expiration')->nullable();
            $table->string('city_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('fcm_token')->nullable();
            $table->enum('status',['0','1'])->default('1');
            $table->string('verified');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
