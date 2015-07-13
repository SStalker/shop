<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table){
            $table->increments('id');
            $table->string('street_address');
            $table->integer('postcode');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('costumer_id');

            $table->foreign('costumer_id')
                ->references('id')
                ->on('costumers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}