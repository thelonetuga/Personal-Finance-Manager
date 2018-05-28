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

            $movements = Movement::where('account_id', '=', Auth::id() )->get();
            $pagetitle = "List of Movements";
            return view('movements.list', compact('movements', 'account', 'pagetitle'));
    }

    public function movementCreate()
    {
        $movement = new Movement();
        $pagetitle = "Create Movement";
        return view('movements.add', compact('movement','pagetitle'));
    }

    public function movementStore(StoreMovementRequest $request)
    {
        $movement = new Movement();
        $movement->fill($request->all());


        $movement->save();

        return redirect()
            ->route('movements.account')
            ->with('success', 'Movement added successfully');
    }

    public function update(UpdateMovementRequest $request, $id)
    {
        if ($request->has('cancel')) {
            return redirect()->action('MovementsController@movementsAccount');
        }

        $movementModel  = $request->validate([
        ], [ // Custom Messages
        ]);
        $movement = Movement::findOrFail($id);
        $movement->fill($movementModel);
        $movement->save();

        return redirect()
            ->route('movements.account')
            ->with('success', 'Movement saved successfully');
    }


}
