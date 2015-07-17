<?php

namespace App;

use Baum;

class Category extends Baum\Node
{
    protected $table = 'categories';

    // 'parent_id' column name
    protected $parentColumn = 'parent_id';

    // 'lft' column name
    protected $leftColumn = 'lft';

    // 'rgt' column name
    protected $rightColumn = 'rft';

    // 'depth' column name
    protected $depthColumn = 'depth';

    // guard attributes from mass-assignment
    protected $guarded = array('id', 'parent_id', 'lft', 'rft', 'depth');

    //Rules
    public static $rules = array(
        'name' => 'required|min:2',
        'parent_id' => 'required|numeric',
        'status' => 'required|boolean'
    );

    public function products(){
        return $this->hasMany('App\Product');
    }
}