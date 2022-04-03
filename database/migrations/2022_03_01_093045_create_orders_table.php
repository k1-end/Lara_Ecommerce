<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user_id');
            $table->integer('amount');
            $table->integer('status');
            $table->boolean('test');
            $table->string('response_id')->nullable();
            $table->string('response_link')->nullable();
            $table->string('response_error_code')->nullable();
            $table->string('response_error_msg')->nullable();
            $table->string('track_id')->nullable();
            $table->string('card_no')->nullable();
            $table->date('date')->nullable();
            $table->string('shipping_addr');
            
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
};
