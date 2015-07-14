<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ExampleProduct::class);
        $this->call(ExampleCategory::class);
        $this->call(CreateRoles::class);
        $this->call(CreatePermissions::class);
        $this->call(AdminUser::class);
        $this->call(CreateBasketAndItems::class);
        Model::reguard();
    }
}
