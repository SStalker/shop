<?php

use Illuminate\Database\Seeder;
use App\Role;

class CreateRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
		$admin->name         = 'admin';
		$admin->display_name = 'User Administrator'; // optional
		$admin->description  = 'User is allowed to manage and edit other users'; // optional
		$admin->save();

		$seller = new Role();
		$seller->name         = 'seller';
		$seller->display_name = 'User Seller'; // optional
		$seller->description  = 'Seller is allowed to manage and edit his articles'; // optional
		$seller->save();

		$customer = new Role();
		$customer->name         = 'customer';
		$customer->display_name = 'User Customer'; // optional
		$customer->description  = 'Customers are allowed to create new shoppingcart and orders'; // optional
		$customer->save();
    }
}
