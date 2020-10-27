<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('village_id');
            $table->string('code');
            $table->string('address_description')->nullable();
            $table->integer('order_cost')->nullable();
            $table->integer('shipping_cost');
            $table->integer('total_cost')->nullable();
            $table->string('coupon')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->enum('status',['0','1','2','3','4'])
                ->comment('0=>new,1=>confirmed,2=>canceled,3=>underway,4=>done');
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
        Schema::dropIfExists('orders');
    }
}
