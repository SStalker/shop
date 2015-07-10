<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema for products table
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->longText('description');
            $table->integer('quantity');
            $table->string('image_path');
            $table->float('price');
            $table->boolean('status'); //The status of the product. Can be set to false (disabled) or true (enabled).
            $table->integer('times_ordered');
            $table->integer('category_id');
            $table->integer('manufacturers_id');
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
        Schema::drop('products');
    }
}
