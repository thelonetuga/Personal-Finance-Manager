<?php

namespace App\Http\Controllers;

use App\Associate;
use App\User;
use Carbon\Carbon;

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

    public function associateOfDelete()
    {
        $id = request()->route('user');
        $users=DB::table('associate_members')->where('associated_user_id', '=', Auth::id())->get();
        foreach($users as $user)
        {
            if($user->main_user_id == $id){
                $find = Associate::findOrfail($id);
                $find->delete();
            }
        }
        return redirect()->route('profiles')->with('success', 'Associate deleted successfully');
    }

    public function associatesPost()
    {
        $main = Auth::user();
        $pedido = request()->get('add');
        $encontrado = User::findOrFail($pedido);
        if ( !is_null($encontrado)) {
            if ($pedido != $main->id) {
                $associate = new Associate([
                    'main_user_id' => $main->id,
                    'associated_user_id' => $pedido,
                    'created_at' => Carbon::now()
                ]);
                $associate->save();
                return redirect()->back();
            }
            return Response::make(view('home'), 403);
        }
        return Response::make(view('dashboard'), 404);
    }

}
