<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

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
        if ($request->user() && $request->user()->admin == 1) {
             return $next($request);
        }
       return Response::make(view('home'),403);
    }
}
