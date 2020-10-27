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
            $table->unsignedInteger('code');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')
                ->on('drivers')->onDelete('cascade');
            $table->string('start_lat');
            $table->string('start_lng');
            $table->string('end_lat');
            $table->string('end_lng');
            $table->date('pickup_time');
            $table->text('description')->nullable();
            $table->unsignedInteger('cost')->nullable();
            $table->unsignedInteger('car_type')->nullable();

            $table->enum('payment_method',['0','1'])
                ->comment('0 =>cash,1 => credit');
            $table->enum('gender',['0','1'])
                ->comment('0 =>male,1 => female')->default('0');
            $table->enum('type',['0','1'])
                ->comment('0 =>people transfer,1 => packages transfer');
            $table->enum('status',['0','1','2','3','4'])
                ->comment('0 =>new,1 => waiting for transmitting,2 =>underway,3 =>done, 4 =>canceled ')->default('0');
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
