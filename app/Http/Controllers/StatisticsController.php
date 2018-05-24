<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $usersCount = User::all()->count();
        $accountsCount = DB::table ('accounts')->get()->count();
        $movementsCount = DB::table ('movements')->get()->count();

        return view('welcome', compact('usersCount', 'accountsCount','movementsCount'));
    }
}
