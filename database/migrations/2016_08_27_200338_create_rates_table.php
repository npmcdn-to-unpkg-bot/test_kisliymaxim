<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->increments('id');
            $table->float('usd_buy')->nullable();
            $table->float('usd_sell')->nullable();
            $table->float('rub_buy')->nullable();
            $table->float('rub_sell')->nullable();
            $table->float('eur_buy')->nullable();
            $table->float('eur_sell')->nullable();
            $table->date('date')->nullable();
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
        Schema::drop('rates');
    }
}
