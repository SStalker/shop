<?php

namespace App\Http\Middleware;

use Closure;
use App\Article;

/**
 * Checks the quantity of every article 
 * If quantity is zero than disable the article
 */
class checkArticleQuantity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $articles = Article::all();

        foreach ($articles as $article) {
            if($article->quantity == 0){
                $article->status = false;
                $article->save();
            }
        }
        return $next($request);
    }
}
