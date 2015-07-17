<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Category;

class ExampleCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
          ['id' => 1, 'name' => 'TV & Home Theather', 'status' => 1],
          ['id' => 2, 'name' => 'Tablets & E-Readers', 'status' => 1],
          ['id' => 3, 'name' => 'Computers', 'status' => 1,'children' => [
            ['id' => 4, 'name' => 'Laptops', 'status' => 1, 'children' => [
              ['id' => 5, 'name' => 'PC Laptops', 'status' => 1],
              ['id' => 6, 'name' => 'Macbooks (Air/Pro)', 'status' => 1]
            ]],
            ['id' => 7, 'name' => 'Desktops', 'status' => 1, 'children' => [
              // These will be created
              ['name' => 'Towers Only', 'status' => 1],
              ['name' => 'Desktop Packages', 'status' => 1],
              ['name' => 'All-in-One Computers', 'status' => 1],
              ['name' => 'Gaming Desktops', 'status' => 1]
            ]]
            // This one, as it's not present, will be deleted
            // ['id' => 8, 'name' => 'Monitors'],
          ]],
          ['id' => 9, 'name' => 'Cell Phones', 'status' => 1]
        ];

        Category::buildTree($categories); // => true
    }
}
