<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Category;
use Request;
use Input;

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
                
                if(is_numeric(Request::segment(2)))
                    $id = Request::segment(2);
                else
                    $id = 1;

                $category = NULL;
                try {
                    $category = Category::findOrFail($id);
                    // ->whereNull('parent_id')
                    //$des = $category->getDescendants()->withoutRoot();

                    //dd($des);

                    //$categories = $category->ancestorsAndSelf()->get();
                    $categories = Category::roots()->get()->toArray();
                    $ancestors = $category->getAncestorsAndSelfWithoutRoot()->toArray();
                    $ancestorRoot = $category->getRoot();
                    //dd($ancestors);
                    //$ancestors->merge($roots);
                    //$roots->get($an)
                    for ($i = 0; $i < count($categories); $i++) {
                        if($categories[$i]['id'] == $ancestorRoot['id'])
                        {
                            
                            $categories[$i]['children'] = $ancestors;
                            
                        }
                    }

                    //dd($roots);
                    //$categories->merge(Category::roots()->get()->toArray());            
                }
                catch(ModelNotFoundException $e) {
                    //$categories = Category::where('parent_id', '=', 1);
                    $categories = Category::roots()->get();
                }

                $view->with('categories', $categories);
            }
        });       
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
