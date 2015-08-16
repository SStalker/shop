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

        $this->call(ExampleArticle::class);
        $this->call(ExampleCategory::class);
        $this->call(CreateRoles::class);
        $this->call(CreatePermissions::class);
        $this->call(AdminUser::class);
        $this->call(CreateBasketAndItems::class);
        $this->call(ExampleOrder::class);
        Model::reguard();
    }
}
