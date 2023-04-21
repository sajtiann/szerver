<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EventController extends Controller
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
        // if(!Auth::check()){
        //     return redirect('games');
        // }

        return view('events.create', [
            'players' => Player::orderBy('team_id')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'minute' => 'required',
            'type' => [
                'required',
                Rule::in(Event::$types),
            ],
            'game_id' => 1,
        ]);

        Event::factory()->create($validated);
        Session::flash('event_created');
        Session::flash('minute', $validated['minute']);
        Session::flash('type', $validated['type']);
        return redirect()->route('events.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        Session::flash('event_deleted');
        $event->delete();
        return redirect()->route('games.index');
    }
}
