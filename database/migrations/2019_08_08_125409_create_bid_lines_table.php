<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bid_id')->unsigned();
            $table->string('image_path');
            $table->string('description');
            $table->string('brand');
            $table->string('retail_price');
            $table->string('trade_price');
            $table->integer('part_availability_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->timestamp('rejected_on')->nullable();
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
        Schema::dropIfExists('bid_lines');
    }
}
