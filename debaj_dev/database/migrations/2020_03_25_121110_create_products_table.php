<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('vendor_id');

            $table->unsignedInteger('category_id');
            $table->string('images')->nullable();
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('shortDetails_ar');
            $table->text('shortDetails_en');
            $table->integer('quantity');
            $table->string('size');
            $table->string('color');
            $table->string('ref');
            $table->text('description_ar');
            $table->text('description_en');
            $table->text('additionalInfo_ar');
            $table->text('additionalInfo_en');
            $table->double('price', 15, 8);
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
        Schema::dropIfExists('products');
    }
}
