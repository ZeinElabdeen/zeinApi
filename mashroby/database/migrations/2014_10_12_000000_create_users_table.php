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
            $table->string('username');
            $table->string('password');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->integer('points')->default('0');
            $table->integer('wallet')->default('0');
            $table->string('reset_password_code')->nullable();
            $table->string('code_expiration')->nullable();
            $table->string('fcm_token')->nullable();
            $table->enum('language',['en','ar'])->default('en');
            $table->enum('status',['0','1'])->default('1');
            $table->string('is_verified');
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
