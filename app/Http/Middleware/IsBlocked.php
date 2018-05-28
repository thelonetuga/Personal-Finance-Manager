<?php

namespace App\Http\Middleware;

use Closure;

class IsBlocked
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
        if($request->user() && $request->user()->blocked == 0) {
             return $next($request);
        }

       return Response::make(view('me.profile'),403);
    }
}
