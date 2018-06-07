<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Account;
use App\Movement;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Laravel\Tinker\ClassAliasAutoloader;

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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function accountsUser($id)
    {
        if (Auth::user()->id == $id) {
            $user_id = Account::where('owner_id', '=', auth()->user()->id)->value('owner_id');
            $accounts = Account::withTrashed()->where('owner_id', '=', $id)->get();
            $pagetitle = "List of Accounts";
            return view('accounts.list', compact('accounts', 'user_id', 'pagetitle'));
        } else {
            return Response::make(view('home'), 403);
        }

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
        return view('accounts.add', compact('account', 'pagetitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $pagetitle = "Edit Account";
        return view('accounts.edit', compact('account', 'pagetitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        if ($request->has('cancel')) {
            return redirect()->route('dashboard');
        }

        $data = $request->validate([
            'account_type_id' => 'required|exists:account_types,id',
            'code' => ['required', 'string', Rule::unique('accounts')->where(function ($query) {
                return $query->where('owner_id', Auth::user()->id);
            })],
            'start_balance' => 'required|numeric',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
        ]);
        //falta formatar a data mo formato Y,M,D

        if (empty($data['date'])){
            $data['date'] = date("Y-m-d");
        }else{
            $data['date'] = date("Y-m-d", strtotime($data['date']));
        }

        $account = Account::create([
            'owner_id' => Auth::id(),
            'account_type_id' => $data['account_type_id'],
            'code' => $data['code'],
            'start_balance' => $data['start_balance'],
            'description' => $data['description'] ?? null,
            'date' => $data['date'],
            'current_balance' => $data['start_balance'],
            'created_at' => Carbon::now(),
        ]);

        $account->save();
        return redirect()->route('dashboard', Auth::user()->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, $id)
    {
        if ($request->has('cancel')) {
            return redirect()->action('AccountsController@accountsUser');
        }
        $account = Account::withTrashed()->findOrFail($id);
        $owner = $account->owner_id;
        $movements = Movement::where('account_id', $account->id)->get();
        $numM = $movements->count();
        $regex = [
            'account_type_id' => 'required|exists:account_types,id',
            'start_balance' => 'required|numeric',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'code' => ['required', 'string', Rule::unique('accounts')->where(function ($query) {
                return $query->where('owner_id', Auth::user()->id);
            })],
        ];

        if ($request['code'] != $account->code) {
            $regex['code'] = ['required', 'string', Rule::unique('accounts')->where(function ($query) {
                return $query->where('owner_id', Auth::user()->id);
            }),
            ];
        }

        $accountModel = $request->validate($regex);
        if ($accountModel['start_balance'] != $account->startbalance) {
            if ($numM == 0) {
                $accountModel['current_balance'] = $accountModel['start_balance'];
            } else {
                $calc = $accountModel['start_balance'] - $account->start_balance;
                $accountModel['current_balance'] = $account->current_balance + $calc;

                for ($i = 0; $i < $numM; $i++) {
                    $movement = $movements->get($i);
                    $movement->start_balance += $calc;
                    $movement->end_balance += $calc;
                    $movement->save();
                }
            }
        }
        $account->date = $regex['date'];

        $account->fill($accountModel);
        $account->save();

        return redirect()
            ->route('accounts.users', compact('owner'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $id
     * @return \Illuminate\Http\Response
     */

    public function accountCLose($id)
    {
        $account = Account::find($id);
        $account->deleted_at == Carbon::now();
        $account->delete();
        return redirect()
            ->route('accounts.users', auth()->user()->id);
    }

    public function accountDelete($id)
    {
        $account = Account::find($id);
        $account->forceDelete();
        return redirect()->route('accounts.users', auth()->user()->id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function accountReopen($id)
    {
        $account = Account::withTrashed()->findOrFail($id);
        if (isset($account)) {
            $account->restore();
            return redirect()->route('accounts.users', auth()->user()->id);
        }
            return Response::make(view('dashboard'), 404);
    }

    public function closed()
    {
        $accounts = Account::onlyTrashed()->where('owner_id', '=', auth()->user()->id)->get();
        $pagetitle = "List of Accounts";
        return view('accounts.list', compact('accounts', 'pagetitle'));
    }

    public function opened()
    {
        $accounts = Account::where('owner_id', '=', auth()->user()->id)->get();
        $pagetitle = "List of Accounts";
        return view('accounts.list', compact('accounts', 'pagetitle'));
    }

}
