<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsOwner
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
        $user_id = Account::where('owner_id', Auth::id())->value('owner_id');
        if (auth()->user()->id == $user_id) {
            return $next($request);
        }

        return Response::make(view('dashboard'),403);
    }
}
