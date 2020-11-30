<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 8, 2)->nullable();
            $table->unsignedBigInteger('parts_request_id')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('delivery_time')->nullable();
            $table->string('delivery_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('parts_request_id')->references('id')->on('parts_requests');
            //$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
    }
}
