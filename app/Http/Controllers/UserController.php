<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Hash;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only(['index', 'blockUser','unBlockUser', 'promoteUser','demoteUser']);
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
    public function index()
    {
        $users = \App\User::all();
        $pagetitle = "List of Users";

        return view('users.list', compact('users', 'pagetitle'));
    }

    public function profiles(Request $request, User $user)
    {
        $pagetitle = "Profiles of Users";
        $name = $request->get('name');
        // Search for a user based on their name.
        if ($request->has('name')) {
            $users = $user->where('name', 'like', '%' . $name . '%')->get();
        }else{
            $users = \App\User::all();
        }

        $associates = DB::table ('associate_members') ->where('main_user_id', '=', Auth::id())->get();
        $associates_of = DB::table ('associate_members') ->where('associated_user_id', '=', Auth::id())->get();

        return view('profiles', compact('users','associates','associates_of', 'pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('users.add', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user','pagetitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {

        $user = User::findOrFail($request->input('user_id'));

        $this->validate($request, [
            'name' => 'required|string|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'numeric|regex:/^[0-9]{9}$/', //(\+351)
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');


        if($request->hasFile('profile_photo')){

            $avatar = $request->file('profile_photo');
            $filename = str_random(32) . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(storage_path('app/public/profiles/'.$filename));

            $user->profile_photo = $filename;
        }

        $user->save();

        return redirect()
            ->route('profile')
            ->with('success', 'User saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function blockUser(User $user)
    {
        $user->toggleBlock();
        $user->save();
        return redirect()->back();
    }

    public function unBlockUser(User $user)
    {
        $user->toggleBlock();
        $user->save();
        return redirect()->back();
    }

    public function promoteUser(User $user)
    {
        $user->toggleDemote();
        $user->save();
        return redirect()->back();
    }

    public function demoteUser(User $user)
    {
        $user->toggleDemote();
        $user->save();
        return redirect()->back();
    }

    public function filter(Request $request, User $user)
    {
        $name = $request->get('name');
        // Search for a user based on their name.
        if ($request->has('name')) {
            $users = $user->where('name', 'like', '%' . $name . '%')->get();
        }
        return view('profiles', compact('users'));
    }
}
