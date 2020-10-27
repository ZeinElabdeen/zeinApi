<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('start_lat');
            $table->string('start_lng');
            $table->string('end_lat');
            $table->string('end_lng');
            $table->date('arriving_date');
            $table->time('arriving_time');
            $table->string('id_number');
            $table->text('description')->nullable();
            $table->enum('type',['0','1','2'])
                ->comment('0 =>other,1 => paper and documents,2 =>food and drinks');
            $table->enum('notes',['0','1','2'])
                ->comment('0 =>no, 1 =>breakable,2 =>low temperature');
            $table->enum('status',['0','1','2','3','4'])
                ->comment('0 =>new,1 => waiting for transmitting,2 =>underway,3 =>done, 4 =>canceled ');
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
        Schema::dropIfExists('packages');
    }
}
