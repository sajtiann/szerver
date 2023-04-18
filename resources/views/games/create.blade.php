@extends('layouts.app')
@section('title', 'Create Game')

@section('content')
<div class="container">
    <h1>Create Game</h1>
    <div class="mb-4">
        <a href="/"><i class="fas fa-long-arrow-alt-left"></i> Back to the homepage</a>
    </div>

    @if (Session::has('game_created'))
        <div class="alert alert-primary">
            <span>The following game is created: </span><span>Start: {{session('start')}}, Home Team Id: {{session('home_team_id')}}, Away Team Id: {{session('away_team_id')}}</span>
        </div>
    @endif

    {{-- TODO: action, method --}}
    <form method="POST" action="{{ route('games.store') }}">
        @csrf

        <div class="form-group row mb-3">
            <label for="start" class="col-sm-2 col-form-label">Start*</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control @error('start') is-invalid @enderror" id="start" name="start" value="{{old('start')}}">
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
                <input type="number" class="form-control @error('home_team_id') is-invalid @enderror" id="home_team_id" name="home_team_id" value="{{old('home_team_id')}}" min="1">
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
                <input type="number" class="form-control @error('away_team_id') is-invalid @enderror" id="away_team_id" name="away_team_id" value="{{old('away_team_id')}}" min="1">
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
