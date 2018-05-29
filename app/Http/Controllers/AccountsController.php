<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Account;
use Illuminate\Support\Facades\Hash;

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
        $user_id = Account::where('owner_id', '=', auth()->user()->id)->value('owner_id');
        $accounts = Account::withTrashed()->where('owner_id', '=', auth()->user()->id )->get();
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
        * Show the form for editing the specified resource.
        *
        * @param  \App\User  $user
        * @return \Illuminate\Http\Response
        */
    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $pagetitle = "Edit Account";
        return view('accounts.edit', compact('account','pagetitle'));
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
        $account->owner_id = auth()->user()->id;
        $account->account_type_id = $request->input('type');
        $account->code = Hash::make($request->code);

        $account->save();

        return redirect()
            ->route('accounts.users', auth()->user()->id)
            ->with('success', 'Account saved successfully');
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
     * @param Account $id
     * @return \Illuminate\Http\Response
     */

    public function accountCLose($id)
    {
        Account::findOrFail($id)->delete();

        return redirect()
            ->route('accounts.users', auth()->user()->id)
            ->with('success', 'Account Close successfully');
    }

    public function accountDelete($id){
        $account = Account::findOrFail($id);
        $account->forceDelete();

        return redirect()
            ->route('accounts.users', auth()->user()->id)
            ->with('success', 'Account saved successfully');
    }

    public function closed(){
        $accounts = Account::onlyTrashed()
            ->where('owner_id', '=', auth()->user()->id )->get();

        $pagetitle = "List of Accounts";
        return view('accounts.list', compact('accounts', 'pagetitle'));
    }

    public function opened(){
        $accounts = Account::where('owner_id', '=', auth()->user()->id )->get();
        $pagetitle = "List of Accounts";
        return view('accounts.list', compact('accounts', 'pagetitle'));
    }

    public function accountReopen($id){
        Account::where('id', $id)->restore();
        return redirect()->route('accounts.users', auth()->user()->id)->with('success', 'Account saved successfully');
    }
}
