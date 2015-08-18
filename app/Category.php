<?php

namespace App;

use Baum;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Baum\Node
{

    use SoftDeletes;

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
        'name' => 'required|min:2|unique:categories,name',
        'parent_id' => 'required|numeric',
        'status' => 'required|boolean'
    );

    public function articles(){
        return $this->hasMany('App\Article');
    }

    /**
     * Overridden delete function cause softdeleting and cascade dont work togehter
     *
     */
    public function delete()
    {
        $descendants = $this->getDescendantsAndSelf();

        foreach ($descendants as $descendant)
                if ($descendant->articles)
                    foreach ($descendant->articles as $article)
                        $article->delete();

        // Now delete the category
        return parent::delete();
    }
}