<?php

namespace App\Http\Middleware;

use App\Account;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

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
        $account = Account::withTrashed()->findorfail($request->route('account'));
        $user_id = Account::withTrashed()->where('owner_id',$account->owner_id)->value('owner_id');
        if (Auth::id() == $user_id) {
            return $next($request);
        }
        return Response::make(view('home'),403);
    }
}
