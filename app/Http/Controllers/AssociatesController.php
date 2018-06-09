<?php

namespace App\Http\Controllers;

use App\Associate;
use App\User;
use Carbon\Carbon;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
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
        $associates = Associate::where('main_user_id', '=', Auth::id())->get();
        return view('me.associates', compact('users', 'associates'));
    }

    public function associatesOf()
    {
        $users = \App\User::all();
        $associates_of = Associate::where('associated_user_id', '=', Auth::id())->get();
        return view('me.associates_of', compact('users', 'associates_of'));
    }

    public function associateOfDelete($user_id)
    {
        if (!$user = User::findOrFail($user_id)){
            $error ="Invalid User";
            return redirect()->back()->with('error',$error);
        }

        $associate = Associate::where('main_user_id', Auth::id())->where('associated_user_id', $user_id);
        if (count($associate->get())){
            $associate->delete();
        }else{
            $error ="Invalid User";
            return Response::make(view('home', compact('error')), 404);
        }

        return redirect()->back()->with('status', 'Associated removed');
    }

    public function associatesPost(Request $request)
    {
        $main = Auth::user();


        $data = $request->validate([
            'associated_user' => ['required', 'exists:users,id','not_in:'.Auth::id(), Rule::unique('associate_members', 'associated_user_id')->where(function ($query){
                return $query->where('main_user_id', Auth::user()->id)->where('associated_user_id','!=', Auth::user()->id);
            })],

        ]);

        if (!$encontrado = User::findOrFail($data['associated_user'])){
            $error ="User Not Found";
            return redirect()->back()->with('error',$error);
        }

        if ($data['associated_user'] == $main->id) {
            $error ="Cannot Associate himself";
            return redirect()->back()->with('error',$error);
        }

        $associate = new Associate([
            'main_user_id' => $main->id,
            'associated_user_id' => $data['associated_user'],
            'created_at' => Carbon::now(),
        ]);
        $associate->save();
        return redirect()->back()->with('status', 'Associated Successful');
    }


}
