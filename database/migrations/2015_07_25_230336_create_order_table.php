<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('orders', function(Blueprint $table)
      {
          $table->increments('id');
          $table->integer('user_id');
          $table->integer('address_id');
          $table->integer('billing_id');
          $table->integer('basket_id');          
          $table->enum('payment_method', ['debit', 'Creditcard']);
          $table->string('coupon_code')->nullable();
          $table->enum('status', ['Paid','Shipped', 'Arrived']);
          
          $table->timestamps();

          $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
          $table->foreign('address_id')
                ->references('id')->on('addresses');
          $table->foreign('billing_id')
                ->references('id')->on('addresses');
          $table->foreign('basket_id')
                ->references('id')->on('baskets');
      });
      
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('orders');
  }
}
