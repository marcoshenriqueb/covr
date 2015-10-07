<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLatestCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latest_currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->double('USD', 14, 6)->unsigned();
            $table->double('CAD', 14, 6)->unsigned();
            $table->double('AUD', 14, 6)->unsigned();
            $table->double('EUR', 14, 6)->unsigned();
            $table->double('GBP', 14, 6)->unsigned();
            $table->double('CLP', 14, 6)->unsigned();
            $table->double('ARS', 14, 6)->unsigned();
            $table->double('MXN', 14, 6)->unsigned();
            $table->string('date');
            $table->string('eTag');
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
        Schema::drop('latest_currencies');
    }
}
