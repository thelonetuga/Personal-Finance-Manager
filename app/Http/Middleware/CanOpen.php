<?php

namespace App\Http\Middleware;

use App\Account;
use Closure;
use Illuminate\Support\Facades\Response;

class CanOpen
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
             if (Account::findorfail($request->route('account'))){
                 if(auth()->user()->id == Account::where('id', $request->route('account'))->owner_id) {
                     return $next($request);
                 }
                 return Response::make(view('home'),403);
             }

             return Response::make(view('home'),404);

    }
}
