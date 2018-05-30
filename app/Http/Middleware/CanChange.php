<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class CanChange
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
        if ($request->route('user')->id != $request->user()->id){
            return $next($request);
        }
        return Response::make(view('dashboard'),403);

    }
}
