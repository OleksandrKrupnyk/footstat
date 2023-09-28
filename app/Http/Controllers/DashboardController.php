<?php

namespace App\Http\Controllers;

use App\Contracts\ClubUserRepositoryContract;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 *
 * Контролер
 * @package App\Http\Controllers
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class DashboardController extends Controller
{
    public function __construct(protected ClubUserRepositoryContract $contract)
    {
    }


    public function index()
    {
        $user = Auth::user();
        return view('dashboard', [
            'user' => $user
        ]);
    }


}
