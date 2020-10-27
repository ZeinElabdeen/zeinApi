<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('category_id');
            $table->string('password');
            $table->string('phone');
            $table->string('email');
            $table->string('lat');
            $table->string('lng');
            $table->double('rate')->default('0')->unsigned();
            $table->string('delivery_time');
            $table->double('delivery_cost');
            $table->enum('status',['0','1'])->default('1');
            $table->string('verified');
            $table->string('image')->nullable();
            $table->string('reset_password_code')->nullable();
            $table->string('code_expiration')->nullable();
            $table->string('fcm_token')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
