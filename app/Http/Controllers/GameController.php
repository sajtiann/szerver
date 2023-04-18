<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('games.index', [
            'games'=>Game::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start' => 'required|date_format:Y-m-d\TH:i|after_or_equal:today',
            'home_team_id' => 'required',
            'away_team_id' => 'required|different:home_team_id',
        ],
        // [
        //     'start.required' => "Kötelező megadni kezdési időpontot!",
        //     'home_team_id.required' => "Kötelező megadni otthoni csapatot!",
        //     'away_team_id.required' => "Kötelező megadni vendég csapatot!",
        // ]
    );
        Game::factory()->create($validated);
        Session::flash('game_created');
        Session::flash('start', $validated['start']);
        Session::flash('home_team_id', $validated['home_team_id']);
        Session::flash('away_team_id', $validated['away_team_id']);
        return redirect()->route('games.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return view('games.show', [
            'game' => $game
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
