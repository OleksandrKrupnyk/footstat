<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserClubController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])
        ->name('dashboard.index');

    Route::get('/leagues', [LeagueController::class, 'index'])
        ->name('leagues.index');

    Route::get('/user-club', [UserClubController::class, 'index'])
        ->name('userclub.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
