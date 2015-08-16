<?php

use Illuminate\Database\Seeder;
use App\Order;

class ExampleOrder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $order->user_id = 2;
        $order->basket_id = 1;
        $order->save();

        $order = new Order();
        $order->user_id = 2;
        $order->basket_id = 2;
        $order->save();

        $order = new Order();
        $order->user_id = 2;
        $order->basket_id = 3;
        $order->save();
    }
}
