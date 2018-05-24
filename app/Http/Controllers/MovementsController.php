<?php

namespace App\Http\Controllers;

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
        $movements = Movement::where('account_id', '=', Auth::id() )->get();
        $pagetitle = "List of Movements";
        return view('movements.list', compact('movements', 'pagetitle'));
    }
}
