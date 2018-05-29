<?php

namespace App\Http\Middleware;

use App\Account;
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
        $account = Account::findorfail($request->route('account'));
        if(auth()->user()->id == $account->owner_id) {
            return $next($request);
        }

        return Response::make(view('me.profile'),403);
    }
}
