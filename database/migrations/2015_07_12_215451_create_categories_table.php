<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema for products table
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rft')->nullable();
            $table->integer('depth')->nullable();
            $table->boolean('status')->nullable(); //The status of the product. Can be set to false (disabled) or true (enabled).
            $table->timestamps();
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
        //Drop Table
        Schema::drop('categories');
    }
}
