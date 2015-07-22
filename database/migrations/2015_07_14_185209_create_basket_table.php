<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baskets', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('session_id');
            $table->integer('total_price');
            $table->integer('total_quantity');
            $table->date('purchaseDate')->nullable();
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
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
        Schema::drop('baskets');
    }
}
