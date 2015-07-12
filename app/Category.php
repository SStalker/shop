<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /*
     *      $table->increments('id');
            $table->string('category_name');
            $table->integer('parent_id');
            $table->boolean('status');
    */
    //
    public function products(){
        return $this->hasMany('App\Product');
    }

    protected $fillable =
        [   'category_name',
            'parent_id',
            'status'
        ];

    //Rules
    public static $rules = array(
        'category_name' => 'required|min:2',
        'parent_id' => 'required|numeric',
        'status' => 'required|boolean'
    );
}
