<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if (! $request->user()->hasRole('admin')) {
            //return response('Unauthorized.', 401);
            //return redirect('errors/403');
            return abort(403);
        }
        return $next($request);
    }
}
