<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\StoreMovementRequest;
use App\Http\Requests\UpdateMovementRequest;
use App\Movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovementsController extends Controller
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
    public function movementsAccount()
    {
            $account = Account::where('owner_id', '=', auth()->user()->id )->value('id');
            $movements = Movement::where('account_id', '=', Auth::id() )->orderby('date', 'desc')->get();
            $pagetitle = "List of Movements";
            return view('movements.list', compact('movements', 'account', 'pagetitle'));
    }

    public function movementCreate()
    {
        $account = Account::where('owner_id', '=', auth()->user()->id )->value('id');
        $movement = new Movement();
        $pagetitle = "Create Movement";
        return view('movements.add', compact('movement', 'account', 'pagetitle'));
    }

    public function edit($id)
    {
        $account = Account::where('owner_id', '=', auth()->user()->id )->value('id');
        $movement = Movement::findOrFail($id);
        $pagetitle = "Edit Movement";
        return view('movements.edit', compact('movement', 'account', 'pagetitle'));
    }

    public function movementDelete($id){
        $movement = Movement::findOrFail($id);
        $movement->forceDelete();

        return redirect()
            ->route('movements.account', auth()->user()->id)
            ->with('success', 'Account saved successfully');
    }

    public function movementStore(StoreMovementRequest $request, $account)
    {
        dump($account);
        $movement = new Movement;
        $movement->fill($request->all());
        $movement->account_id =$account;
        $movement->movement_category_id = $request->input('category');

        $number = $movement->movement_category_id;
        
        if( ($number > 1) && $number < 12){
            $movement->type = 'expense';
        }else{
            $movement->type = 'revenue';
        }
        $movement->start_balance = $request->input('startBalance');

        if($movement->type == 'revenue'){
            $movement->end_balance = $movement->start_balance + $movement->value;
        }else{
            $movement->end_balance = $movement->start_balance - $movement->value;
        }

        $movement->description =$request->input('comment');

        $movement->save();

        return redirect()
            ->route('movements.account', $account)
            ->with('success', 'Movement added successfully');
    }

    public function update(UpdateMovementRequest $request, $id)
    {
        if ($request->has('cancel')) {
            return redirect()->action('MovementsController@movementsAccount');
        }

        $movementModel  = $request->validate([
        ], [
            //
        ]);
        $movement = Movement::findOrFail($id);
        $movement->fill($movementModel);
        $movement->save();

        return redirect()
            ->route('movements.account')
            ->with('success', 'Movement saved successfully');
    }

}
