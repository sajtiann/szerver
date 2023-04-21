<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Game;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('games.index', [
            'games' => Game::orderBy('start')->orderBy('number')->get(),
        ]);

        // DB::table('games')->orderBy('start', 'desc')->get()
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

        $game = Game::factory()->create([
            'start' => $validated['start'],
            'home_team_id' => $validated['home_team_id'],
            'away_team_id' => $validated['away_team_id'],
        ]);
        Session::flash('game_created', $validated['start']);
        return redirect()->route('games.show', $game);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return view('games.show', [
            'game' => $game,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('games.edit', [
            'game' => $game,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'start' => 'required|date_format:Y-m-d\TH:i|after_or_equal:today',
            'home_team_id' => 'required',
            'away_team_id' => 'required|different:home_team_id',
        ]);

        $game->start = $validated['start'];
        $game->start = $validated['home_team_id'];
        $game->start = $validated['away_team_id'];
        $game->save();
        Session::flash('game_edited',$validated['start']);

        return redirect()->route('games.show',$game);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $this->authorize('delete', $game);
        Session::flash('game_deleted', $game['start']);
        $game->delete();
        return redirect()->route('games.index');
    }
}
