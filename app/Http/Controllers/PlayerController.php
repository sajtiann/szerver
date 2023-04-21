<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('players.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'number' => 'required|integer|between:1,99',
            'birthdate' => 'required|date_format:Y-m-d\TH:i|before:-18 years|after:-35 years',
        ]);

        $player = Player::factory()->create([
            'name' => $validated['name'],
            'number' => $validated['number'],
            'birthdate' => $validated['birthdate'],
            'team_id' => 1,
        ]);

        Session::flash('player_created');
        Session::flash('name', $validated['name']);
        Session::flash('number', $validated['number']);
        Session::flash('birthdate', $validated['birthdate']);
        return redirect()->route('players.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }
}
