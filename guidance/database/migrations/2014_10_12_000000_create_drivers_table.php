<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('id_number');
            $table->string('car_color');
            /**images*/
            $table->string('id_image');
            $table->string('car_front_image');
            $table->string('car_back_image');
            $table->string('car_form_image');
            $table->string('driving_license_image');
            /**relations*/
            $table->unsignedInteger('car_model_id');
            $table->unsignedInteger('car_type_id');

            $table->enum('gender',['0','1'])->comment('0 => male, 1 => female');
            $table->enum('service',['0','1'])->comment('0 => people driver, 1 => package driver');

            $table->unsignedTinyInteger('rate')->default(0);
            $table->string('reset_password_code')->nullable();
            $table->string('code_expiration')->nullable();
            $table->string('fcm_token')->nullable();
            $table->enum('status',['0','1'])->default('1');
            $table->enum('notification',['0','1'])->default('1');
            $table->string('verified');
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
        Schema::dropIfExists('drivers');
    }
}
