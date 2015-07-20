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

        function renderNode($node, $mode) {
            if($mode == 'plain') {
                $classLi = '';
                $classUl = '';
                $classSpan = '';
            }                
            else{
                $classLi = 'list-group-item';
                $classUl = 'list-group';
                $classSpan = 'glyphicon glyphicon-pencil text-primary';
            }
            if( empty($node['children']) ) {
                return '<li class="'.$classLi.'"> <span class="'.$classSpan.'"></span><a href="'.url('categories/'. $node['id']).'">'. $node['name'] . '</a></li>';
            } else {
                //$html = "Anzahl Kinder von:". $node['name'] . ' -> ' . count($node['children']);
                $html = '<li class="'.$classLi.'"> <span class="'.$classSpan.'"></span><a href="'.url('categories/'. $node['id']).'">'. $node['name'] . '</a>';
                $html .= '<ul class="'.$classUl.'">';

                foreach($node['children'] as $child)
                    $html .= renderNode($child, $mode);

                $html .= '</ul>';
                $html .= '</li>';
            }
            
            return $html;
    }

  HTML::macro('printNodes', function($nodes, $mode) {
    return renderNode($nodes, $mode);
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
