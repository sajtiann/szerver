<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('teams.index', [
            'teams'=>Team::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:teams,name',
            'shortname' => 'required|unique:teams,shortname|max:4',
            'image' => 'nullable|file|mimes:jpg,png|max:4096',
        ]);

        $image_path = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image_path = 'image_'.Str::random(10).'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->put($image_path,$file->get());
        }

        $team = Team::factory()->create([
            'name' => $validated['name'],
            'shortname' => $validated['shortname'],
            'image' => $image_path ? $image_path : null,
        ]);

        Session::flash('team_created');
        Session::flash('name', $validated['name']);
        Session::flash('shortname', $validated['shortname']);
        return redirect()->route('teams.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return view('teams.show', [
            'team' => $team
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
