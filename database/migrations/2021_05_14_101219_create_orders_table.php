<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table -> unsignedBigInteger('transaction_id');
            $table -> unsignedBigInteger('product_id');
            $table -> integer('count');
            $table->timestamps();
        });
        Schema::table('orders',function (Blueprint $table){
            $table -> foreign('transaction_id')
                -> references('id')
                ->on('transactions');
            $table -> foreign('product_id')
                -> references('id')
                ->on('products');
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
