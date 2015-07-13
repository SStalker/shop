<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExampleProduct extends Seeder
{

    /*
     *  Columns
     *
        increments('id');
        string('product_name');
        longText('description');
        integer('quantity');
        string('image_path');
        float('price');
        boolean('status'); //The status of the product. Can be set to false (disabled) or true (enabled).
        integer('times_ordered');
        integer('category_id');
        integer('manufacturers_id');
        timestamps();
        softDeletes();
    */

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product_name' => 'Test Produkt',
            'description' => 'test',
            'quantity' => '42',
            'image_path' => 'test_img.jpg',
            'price' => '21.42',
            'status' => 'true',
            'times_ordered' => '0',
            'category_id' => '1',
            'manufacturers_id' => '42',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
