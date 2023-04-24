<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        return view('table.index', [
            'games' => Game::where('finished', true)->get(),
        ]);
    }
}
