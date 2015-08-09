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
          ['name' => 'TV & Home Theather', 'status' => 1, 'children' => [
              ['name' => 'TV-Geräte', 'status' => 1],
              ['name' => 'Beamer', 'status' => 1],
              ['name' => 'DVD & Blue-ray', 'status' => 1]
          ]],
          ['name' => 'Tablets & E-Readers', 'status' => 1, 'children' => [
              ['name' => 'Tablets', 'status' => 1],
              ['name' => 'E-Reader', 'status' => 1]
          ]],
          ['name' => 'Handy & Smartphones', 'status' => 1],
          ['name' => 'Notebooks', 'status' => 1, 'children' => [
              ['name' => 'Windows', 'status' => 1, 'children' => [
                  ['name' => 'Businness-Notebooks', 'status' => 1],
                  ['name' => 'Gaming-Notebooks', 'status' => 1]
              ]],
              ['name' => 'Mac-OS', 'status' => 1, 'children' => [
                  ['name' => 'Macbook Pro', 'status' => 1],
                  ['name' => 'Macbook Air', 'status' => 1]
              ]],
          ]],
          ['name' => 'Desktop Systeme', 'status' => 1, 'children' => [
              // These will be created
              ['name' => 'Personal Computer', 'status' => 1],
              ['name' => 'All-in-One', 'status' => 1],
              ['name' => 'Komplettsysteme', 'status' => 1],
              ['name' => 'Gaming Desktops', 'status' => 1]
          ]],
            // This one, as it's not present, will be deleted
            // [  8, 'name' => 'Monitors'],
          ['name' => 'Peripherie', 'status' => 1, 'children' => [
              ['name' => 'Mäuse', 'status' => 1],
              ['name' => 'Tastaturen', 'status' => 1],
              ['name' => 'Monnitore', 'status' => 1],
              ['name' => 'Drucker', 'status' => 1],
              ['name' => 'Sonstiges', 'status' => 1]
          ]]
        ];

        Category::buildTree($categories); // => true
    }
}
