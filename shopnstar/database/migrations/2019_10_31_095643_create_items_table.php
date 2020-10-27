<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('sub_category_id');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')
                ->on('vendors')->onDelete('cascade');
            $table->unsignedTinyInteger('price_type');
            $table->string('title');
            $table->integer('price');
            $table->text('description');
            $table->integer('discount')->nullable();
            $table->enum('type',['0','1'])->comment('0 => normal item , 1 => item with offer');
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
        Schema::dropIfExists('items');
    }
}
