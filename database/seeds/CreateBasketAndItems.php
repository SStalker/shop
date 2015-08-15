<?php

use Illuminate\Database\Seeder;
use App\Basket;
use App\User;
use Carbon\Carbon;

class CreateBasketAndItems extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
    	$customer = User::find(1);
        $basket = new Basket();
		$basket->user_id  = $customer->id;
		$basket->total_price = 0;
		$basket->total_quantity  = 0;
		$basket->purchaseDate = null;
		$basket->active = 1;
		$basket->save();

		$basket->articles()->attach(1, ['quantity' => 1, 'price' => 1]);
        */
    }
}
