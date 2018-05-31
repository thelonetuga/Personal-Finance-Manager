<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\ConfirmPassword;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function updatePassword(Request $request){


        $this->validate($request,[
            'old_password' => ['required', new ConfirmPassword],
            'password' => 'required|min:3|confirmed|different:old_password',
            'password_confirmation'=> 'required|same:password',
        ]);


        $user=User::findOrFail(Auth::user()->id);
        $user->password = Hash::make($request->input('password'));
        $user->save();


        return redirect()
            ->route('dashboard',$user->id)
            ->with('success', 'User password update successfully');

    }
    public function showForm(){
        return view('auth.passwords.change');
    }

}
