<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
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

    //Belongs to One Category
    /*public function category(){
        return $this->belongsTo('App\Category');
    }*/

    //Rules
    public static $rules = array(
        'product_name' => 'required|min:2',
        'quantity' => 'required|numeric',
        'price' => 'required|numeric',
        'status' => 'required|boolean',
        'category_id' => 'required|numeric',
        'manufacturers_id' => 'required|numeric'
    );
}
