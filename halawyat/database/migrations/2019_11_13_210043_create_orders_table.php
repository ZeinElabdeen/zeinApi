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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('code');
            $table->integer('order_cost')->nullable();
            $table->integer('delivery_cost')->nullable();
            $table->integer('total_cost')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->enum('status',['0','1','2','3','4'])
                ->comment('0=>new,1=>confirmed,2=>canceled,3=>underway,4=>done');
            $table->enum('payment_method',['0','1'])
                ->comment('0 => online, 1=>cash on delivery');
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
