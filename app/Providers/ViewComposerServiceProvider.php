<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Category;
use Request;
use Input;
use Illuminate\Support\Facades\Session;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        view()->composer('layouts.menuleft', function($view){

            if(Request::segment(1) == 'categories'){
                
                if(is_numeric(Request::segment(2))){
                    $id = Request::segment(2);
                    Session::put('category_id', $id);
                }                
                else{
                    $id = 1;
                    Session::put('category_id', $id);
                }

                $categories = $this->getCategories($id);
            }
            else            
                $categories = $this->getCategories(Session::get('category_id'));            

            $view->with('categories', $categories);

        });       
    }

    public function getCategories($id)
    {
        try {
            $category = Category::findOrFail($id);
            $ancestors = $category->getAncestorsAndSelf();            
            $categories = new \Baum\Extensions\Eloquent\Collection;

            // Collection as Model
            foreach ($ancestors as $key => $ancestor) {
                $categories[] = $ancestor;
                foreach ($ancestor->getSiblings() as $sibling) 
                    $categories[] = $sibling;                
                    
                if($ancestor->id == $category->id) 
                    foreach ($ancestor->children as $child) 
                        $categories[] = $child;                
            }

            $categories = $categories->toHierarchy()->toArray();
            return $categories;

        } catch(ModelNotFoundException $e) {
            $categories = Category::roots()->get()->toArray();
            return $categories;
        }  
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
