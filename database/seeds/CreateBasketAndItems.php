<?php

use Illuminate\Database\Seeder;
use App\Basket;
use App\Article;
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
        $basket = new Basket();
        $basket->user_id = 2;
        $basket->active = 1;
        $basket->session_id = '91e4f6c857cfc2be394d4c4ad8c85d640dc7bebd';

        $basket->save();

        for ($i = 1; $i <= 3; $i++)
        {
            $articlesOfBasket = $basket->articles();
            $articlesOfBasket->attach($i, ['quantity' => 1, 'price' => Article::find($i)->price]);
            $basket->total_price += Article::find($i)->price;
            $basket->total_quantity += 1;
        }

        $basket->update();

        $basket = new Basket();
        $basket->user_id = 2;
        $basket->active = 1;
        $basket->session_id = '50c35304992643c8944882c660a7fb460cd4cace';

        $basket->save();

        for ($i = 3; $i <= 6; $i++)
        {
            $articlesOfBasket = $basket->articles();
            $articlesOfBasket->attach($i, ['quantity' => 1, 'price' => Article::find($i)->price]);
            $basket->total_price += Article::find($i)->price;
            $basket->total_quantity += 1;
        }

        $basket->update();

        $basket = new Basket();
        $basket->user_id = 2;
        $basket->active = 1;
        $basket->session_id = 'ed0985c416ca9ba91245738f39a0f43d10422d26';

        $basket->save();

        for ($i = 6; $i <= 9; $i++)
        {
            $articlesOfBasket = $basket->articles();
            $articlesOfBasket->attach($i, ['quantity' => 1, 'price' => Article::find($i)->price]);
            $basket->total_price += Article::find($i)->price;
            $basket->total_quantity += 1;
        }

        $basket->update();

    }
}
