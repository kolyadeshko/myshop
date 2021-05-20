<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table-> unsignedBigInteger('transaction_status_id');
            $table->timestamps();
        });
        Schema::table('transactions',function (Blueprint $table){
            $table
                -> foreign('user_id')
                -> references('id')
                -> on('users');
            $table
                -> foreign('transaction_status_id')
                -> references('id')
                -> on('transaction_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
