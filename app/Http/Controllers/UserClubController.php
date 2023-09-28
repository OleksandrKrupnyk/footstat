<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserClubController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('userclub', [
            'user' => $user
        ]);
    }
}
