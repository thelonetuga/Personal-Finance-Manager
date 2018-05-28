<?php

namespace App\Http\Controllers;

use App\Account;
use App\Movement;
use Illuminate\Http\Request;
use App\User;
use DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $usersCount = User::all()->count();
        $accountsCount = Account::all()->count();
        $movementsCount = Movement::all()->count();

        return view('welcome', compact('usersCount', 'accountsCount','movementsCount'));
    }
}
