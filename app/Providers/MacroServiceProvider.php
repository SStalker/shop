<?php

namespace App\Providers;

use HTML;
use Illuminate\Support\ServiceProvider;
        
class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        function renderNode($node) {
            //dd($node);
              
            if( empty($node['children']) ) {
                return '<li class="list-group-item"> <span class="glyphicon glyphicon-pencil text-primary"></span><a href="'.url('categories/'. $node['id']).'">'. $node['name'] . '</a></li>';
            } else {
                //$html = "Anzahl Kinder von:". $node['name'] . ' -> ' . count($node['children']);
                $html = '<li class="list-group-item"> <span class="glyphicon glyphicon-pencil text-primary"></span><a href="'.url('categories/'. $node['id']).'">'. $node['name'] . '</a>';
                $html .= '<ul class="list-group">';

                foreach($node['children'] as $child)
                    $html .= renderNode($child);

                $html .= '</ul>';
                $html .= '</li>';
            }
            
            return $html;
    }

  HTML::macro('printNodes', function($nodes) {
    return renderNode($nodes);
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
