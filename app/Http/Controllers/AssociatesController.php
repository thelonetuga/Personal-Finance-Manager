<?php

namespace App\Http\Controllers;

use App\Associate;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;


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
        $associates = DB::table ('associate_members') ->where('main_user_id', '=', Auth::id())->get();
        return view('me.associates', compact('users','associates'));
    }

    public function associatesOf()
    {
        $users = \App\User::all();
        $associates_of = DB::table ('associate_members') ->where('associated_user_id', '=', Auth::id())->get();
        return view('me.associates_of', compact('users','associates_of'));
    }

    public function associateOfDelete()
    {

        DB::table ('associate_members') ->where('associated_user_id', '=', Auth::id())->delete();

        return redirect()->route('profiles')->with('success', 'Associate deleted successfully');
    }

    public function associatesPost()
    {
        $main = Auth::user();

        $associate = new Associate([
            'main_user_id' => $main->id,
            'associated_user_id' =>  request()->get('add_user'),
            'created_at' => Carbon::now()
        ]);
        $associate->save();
        return redirect()->back();
    }

}
