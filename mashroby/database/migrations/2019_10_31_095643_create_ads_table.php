<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('category_id');
            $table->unsignedTinyInteger('size_id');
            $table->string('title_ar');
            $table->string('title_en');
            $table->integer('price');
            $table->string('image');
            $table->enum('type',['1','2'])->comment('1 => normal ad , 2 => ad with offer');
            $table->enum('status',['1','2']);
            $table->integer('discount')->nullable();
            $table->integer('stock')->default('0');
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
        Schema::dropIfExists('ads');
    }
}
