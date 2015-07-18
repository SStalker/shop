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
  if( !array_key_exists('children', $node)) {
    return '<li>' . $node['name'] . '</li>';
  } else {
    $html = '<li>' . $node['name'];

    $html .= '<ul>';

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
