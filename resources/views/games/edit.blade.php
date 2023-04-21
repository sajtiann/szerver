@extends('layouts.app')
@section('title', 'Edit game')

@section('content')
<div class="container">
    <h1>Create post</h1>
    <div class="mb-4">
        <a href="{{ route('games.index') }}"><i class="fas fa-long-arrow-alt-left"></i> Back to the homepage</a>
    </div>

    <form method="post" action={{ route('games.update', $game) }}>
        @method('PUT')
        @csrf
        {{-- TODO: Validation --}}

        <div class="form-group row mb-3">
            <label for="start" class="col-sm-2 col-form-label">Start*</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control @error('start') is-invalid @enderror" id="start" name="start" value="{{old('start', $game->start)}}">
                @error('start')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="home_team_id" class="col-sm-2 col-form-label">Home Team Id*</label>
            <div class="col-sm-10">
                <input type="number" class="form-control @error('home_team_id') is-invalid @enderror" id="home_team_id" name="home_team_id" value="{{old('home_team_id', $game->home_team_id)}}" min="1">
                @error('home_team_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="away_team_id" class="col-sm-2 col-form-label">Away Team Id*</label>
            <div class="col-sm-10">
                <input type="number" class="form-control @error('away_team_id') is-invalid @enderror" id="away_team_id" name="away_team_id" value="{{old('away_team_id', $game->away_team_id)}}" min="1">
                @error('away_team_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Store</button>
        </div>

    </form>
</div>
@endsection
