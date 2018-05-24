<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Account;
//$aux = \App\User::id();

class AccountsController extends Controller
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
    public function accountsUser()
    {
      // $accounts = Account::where('owner_id', '=', Auth::id() )->get();
        $accounts = Account::where('owner_id', '=', auth()->user()->id )->get();
        $user_id = Account::where('owner_id', '=', auth()->user()->id)->value('owner_id');
        $pagetitle = "List of Accounts";
        return view('accounts.list', compact('accounts','user_id', 'pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = new Account();
        $pagetitle = "Add Account";
        return view('accounts.add', compact('account','pagetitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        $account = new Account;
        $account->fill($request->all());
        $account->code = Hash::make($request->code);

        $account->save();

        return redirect()
            ->route('accounts.users')
            ->with('success', 'Account added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($account_id)
    {
        $account = Account::findOrFail($account_id);
        return view('accounts.edit', compact('account','pagetitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, $id)
    {
        if ($request->has('cancel')) {
            return redirect()->action('AccountsController@accountsUser');
        }

        $accountModel  = $request->validate([
        ], [ // Custom Messages
        ]);
        $account = Account::findOrFail($id);
        $account->fill($accountModel);
        $account->save();

        return redirect()
            ->route('accounts.users')
            ->with('success', 'Account saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function accountDelete($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()
            ->view('accounts.users')
            ->with('success', 'Account deleted successfully');
    }


}
