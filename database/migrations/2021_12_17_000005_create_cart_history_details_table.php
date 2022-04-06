<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartHistoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_history_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts');
            $table->string('name');
            $table->integer('price');
            $table->string('image_path');
            $table->integer('quantity');
            $table->integer('subtotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_history_details');
    }
}
