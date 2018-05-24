<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reset(UpdateUserRequest $request){
        $user = User::findOrFail($request->input('user_id'));

        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:6|same:password_confirmation',
        ]);

        $current_password = Auth::User()->password;

        if(($request['old_password'] != $current_password))
        {
            $user->password = $request->input(bcrypt('password'));
            $user->save();
        }
        return redirect()
            ->route('profile')
            ->with('success', 'User password update successfully');

    }
}
