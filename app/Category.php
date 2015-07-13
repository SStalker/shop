<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /*
     *      $table->increments('id');
            $table->string('name');
            $table->integer('parent_id');
            $table->boolean('status');
    */
    //
    public function products(){
        return $this->hasMany('App\Product');
    }

    protected $fillable =
        [   'name',
            'parent_id',
            'status'
        ];

    //Rules
    public static $rules = array(
        'name' => 'required|min:2',
        'parent_id' => 'required|numeric',
        'status' => 'required|boolean'
    );
}
