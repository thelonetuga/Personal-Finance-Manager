<?php

namespace App\Http\Controllers;

use App\Associate;
use App\User;
use Carbon\Carbon;

use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


class AssociatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('/me/profile');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function associatesGet()
    {
        $users = \App\User::all();
        $associates = DB::table('associate_members')->where('main_user_id', '=', Auth::id())->get();
        return view('me.associates', compact('users', 'associates'));
    }

    public function associatesOf()
    {
        $users = \App\User::all();
        $associates_of = DB::table('associate_members')->where('associated_user_id', '=', Auth::id())->get();
        return view('me.associates_of', compact('users', 'associates_of'));
    }

    public function associateOfDelete($user_id)
    {

        if (Auth::user()->id != $user_id){
            $members = Associate::where('associated_user_id', Auth::id())->get();
            $encontrado = User::findOrFail($user_id);
            if (isset($encontrado)) {
                foreach ($members as $member) {
                    if ($member->main_user_id == $encontrado->id) {
                        $toDelete = DB::table('associate_members')->where('associated_user_id', '=', $member->associated_user_id)
                            ->where('main_user_id', '=', $member->main_user_id)->get();
                        $toDelete->delete();
                        return redirect()->route('profiles');
                    }
                }
                return Response::make(view('dashboard'), 404);
            } else {
                return Response::make(view('dashboard'), 404);
            }
        }else{
            return Response::make(view('dashboard'), 403);
        }


    }

    public function associatesPost(Request $request)
    {
        $main = Auth::user();
        $pedido =$request->get('associate_id');
        $encontrado = User::findOrFail($pedido);
        if (!is_null($encontrado)) {
            if ($pedido != $main->id) {
                $associate = new Associate([
                    'main_user_id' => $main->id,
                    'associated_user_id' => $pedido,
                    'created_at' => Carbon::now(),
                ]);
                $associate->save();
                return redirect()->route('home');
            }
            return Response::make(view('home'), 403);
        }
        return Response::make(view('dashboard'), 404);
    }

}
