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
        Schema::table('cart', function (Blueprint $table) {
            $table->integer('order_id')->nullable();
            $table->integer('quantity');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('cart', 'order_id')) {
            Schema::table('cart', function (Blueprint $table) {
                $table->dropColumn('order_id');
            });
        }
        if (Schema::hasColumn('cart', 'quantity')) {
            Schema::table('cart', function (Blueprint $table) {
                $table->dropColumn('quantity');
            });
        }
        
    }
};
