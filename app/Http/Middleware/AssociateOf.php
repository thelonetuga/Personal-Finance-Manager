<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AssociateOf
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
        if (User::findorfail($request->route('user'))){
            if (Auth::user() && ($request->route('user') == Auth::user()->id || count(DB::table('associate_members')->where('associated_user_id', Auth::user()->id)->where('main_user_id',$request->route('user') )->get())>0)){
                return $next($request);
            }
            return Response::make(view('dashboard'),403);
        }else{
            return Response::make(view('welcome'),404);
        }
    }
}
