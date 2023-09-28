<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LeagueController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        return view('league', [
            'user' => $user
        ]);
    }
}
