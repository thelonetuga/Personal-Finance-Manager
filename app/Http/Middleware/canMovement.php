<?php

namespace App\Http\Middleware;

use App\Account;
use App\Movement;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class canMovement
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
        $movement= Movement::findorfail($request->route('movement'));
        $id = $movement->account_id;
        $account = Account::findorfail($id);
        $user_id = Account::where('owner_id',$account->owner_id)->value('owner_id');
        if (Auth::id() == $user_id) {
            return $next($request);
        }
        return Response::make(view('home'),403);
    }
}
