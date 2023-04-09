<?php

use App\Models\Game;
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

Route::get('/games', function () {
    return view('games', [
        'games' => Game::all()
    ]);
});

Route::get('/teams', function () {
    return view('teams');
});

Route::get('/table', function () {
    return view('table');
});

Route::get('/favourites', function () {
    return view('favourites');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
