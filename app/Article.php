<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /*
     *  Columns
     *
        increments('id');
        string('article_name');
        longText('description');
        integer('quantity');
        string('image_path');
        float('price');
        boolean('status'); //The status of the article. Can be set to false (disabled) or true (enabled).
        integer('times_ordered');
        integer('category_id');
        integer('manufacturers_id');
        timestamps();
        softDeletes();
    */

    //Belongs to One Category
    public function category(){
        return $this->belongsTo('App\Category');
    }

    protected $fillable =
        [   'name',
            'description',
            'quantity',
            'image_path',
            'price',
            'status',
            'times_ordered',
            'category_id',
            'manufacturers_id'
        ];

    //Rules
    public static $rules = array(
        'name' => 'required|min:2',
        'quantity' => 'required|numeric',
        'price' => array('required','regex:/^([1-9][0-9]*|0)(\.[0-9]{2})?$/'),
        'status' => 'required|boolean',
        'category_id' => 'required|numeric|min:1'
    );

    public function baskets()
    {
        return $this->belonsToMany('App\Basket')->withTimestamps();
    }


    public function getPriceAttribute($price)
    {
        return money_format('%.2n', $price);
    }


}
