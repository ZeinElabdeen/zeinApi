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
            $table->string('code');
            $table->integer('order_cost')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('total_cost')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->string('promo_code');
            $table->string('order_creation_date')->comment('store order date and updated every repeat');
            $table->enum('status',['0','1','2','3','4'])
                ->comment('0=>new,1=>confirmed,2=>canceled,3=>underway,4=>done');
            $table->enum('payment_method',['1','2','3','4','5'])
                ->comment('1=>cash,2=>visa,3=>master,4=>mda,5=>sdad');
            $table->enum('delivery_time',['1','2','3'])
                ->comment('1=>morning,2=>night,3=>any time');
            $table->enum('repeat',['1','2','3'])
                ->comment('1=>once,2=>every 2 week,3=>every month');
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
