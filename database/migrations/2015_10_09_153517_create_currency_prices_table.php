<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('available_currency_ticker');
            $table->double('price', 14, 6)->unsigned();
            $table->integer('currency_batch_id')->unsigned();
            $table->foreign('available_currency_ticker')->references('ticker')->on('available_currencies')->onDelete('cascade');
            $table->foreign('currency_batch_id')->references('id')->on('currencies_batch')->onDelete('cascade');
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
        Schema::drop('currency_prices');
    }
}
