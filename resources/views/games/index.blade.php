@extends('layouts.app')
@section('title', 'Games')

<style>
	body {
		margin: 0;
		padding: 0;
		background-color: #f5f5f5;
		font-family: Arial, sans-serif;
	}

	.match-container {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			padding: 20px;
			background-color: white;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			margin: 20px auto;
			max-width: 800px;
			transition: all 0.2s ease;
			width: 90%;
		}

		.match-container:hover {
			transform: translateY(-5px);
			box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		}

		.match-container.highlight {
			background-color: #ffef96;
		}

		.match-container.current {
			background-color: #00a651;
			color: white;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		}

		.match-container .team-logo {
			height: 50px;
			width: 50px;
			object-fit: contain;
			margin: 5px;
		}

		.match-container .team-name {
			font-size: 1.2em;
			font-weight: bold;
			margin: 0 10px;
		}

		.match-container .score {
			font-size: 1.2em;
			font-weight: bold;
			margin: 0 10px;
			flex-shrink: 0;
		}

		.match-container .time {
			font-size: 1.2em;
			font-weight: bold;
			margin-left: auto;
		}

		.section-heading {
			background-color: #cfcfcf;
			color: rgb(39, 39, 39);
			padding: 10px;
			text-align: center;
			margin: 20px auto;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			max-width: 800px;
			width: 90%;
		}
</style>

@section('content')
<div class="container">
    @if (Session::has('game_deleted'))
        <div class="alert alert-primary">
            <span>You have successfully deleted the game.</span>
        </div>
    @endif
    @if (Session::has('event_deleted'))
        <div class="alert alert-primary">
            <span>You have successfully deleted the event.</span>
        </div>
    @endif

<div class="row justify-content-between">
    <div class="col-12 col-md-8">
        <h1>Matches</h1>
    </div>
    <div class="col-12 col-md-4">
        <div class="float-lg-end">
                @can('create', App\Models\Game::class)
                    <a href="{{ route('games.create')}}" role="button" class="btn btn-sm btn-success mb-1"><i class="fas fa-plus-circle"></i> Create game</a>
                @endcan
        </div>
    </div>
</div>

<div class="section-heading">
    <h2>Ongoing matches</h2>
</div>

@forelse ($games as $game)
    @php
        $date = \Carbon\Carbon::parse($game->start);
        $today = \Carbon\Carbon::today();
    @endphp
    @if (!$game->finished && $date->lt($today))
        <a href="{{ route('games.show', $game)}}" style="text-decoration: none">
            <div class="match-container current">
                <img class="team-logo" src={{$game->home_team->image ? ((Str::contains($game->home_team->image, 'https')) ?  $game->home_team->image : asset('storage/'.$game->home_team->image)) : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Home Team Image">
                <span class="team-name">{{ $game->home_team->name}} ({{ $game->home_team->shortname}})</span>
                @php
                    $homeScore = 0;
                    $awayScore = 0;
                    foreach ($game->events as $event) {
                        if ($event->type === 'goal') {
                            $playerTeam = $event->player->team_id;
                            if ($playerTeam === $game->home_team_id) {
                                $homeScore++;
                            } else {
                                $awayScore++;
                            }
                        } elseif ($event->type === 'own_goal') {
                            $playerTeam = $event->player->team_id;
                            if ($playerTeam === $game->home_team_id) {
                                $awayScore++;
                            } else {
                                $homeScore++;
                            }
                        }
                    }
                @endphp
                <span class="score" >{{$homeScore}} - {{$awayScore}}</span>
                <img class="team-logo" src={{$game->away_team->image ? ((Str::contains($game->away_team->image, 'https')) ?  $game->away_team->image : asset('storage/'.$game->away_team->image)) : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Away Team Image">
                <span class="team-name">{{ $game->away_team->name }} ({{ $game->away_team->shortname}})</span>
                <span class="time">{{ $game->start }}</span>
            </div>
        </a>
    @endif
@empty
    <div class="col-12">
        <div class="alert alert-warning" role="alert">
            No matches available!
        </div>
    </div>
@endforelse

<div class="section-heading">
    <h2>Upcoming matches</h2>
</div>

@forelse ($games as $game)
    @php
        $date = \Carbon\Carbon::parse($game->start);
        $today = \Carbon\Carbon::today();
    @endphp
    @if (!$game->finished && $date->gt($today))
    <a href="{{ route('games.show', $game)}}" style="text-decoration: none; color: black">
    <div class="match-container">
        <img class="team-logo" src={{$game->home_team->image ? ((Str::contains($game->home_team->image, 'https')) ?  $game->home_team->image : asset('storage/'.$game->home_team->image)) : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Home Team Image">
        <span class="team-name">{{ $game->home_team->name}} ({{ $game->home_team->shortname}})</span>
        <span class="score" >vs</span>
        <img class="team-logo" src={{$game->away_team->image ? ((Str::contains($game->away_team->image, 'https')) ?  $game->away_team->image : asset('storage/'.$game->away_team->image)) : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Away Team Image">
        <span class="team-name">{{ $game->away_team->name }} ({{ $game->away_team->shortname}})</span>
        <span class="time"> Match Date: {{ $game->start }}</span>
    </div>
    </a>
    @endif
@empty
    <div class="col-12">
        <div class="alert alert-warning" role="alert">
            No matches available!
        </div>
    </div>
@endforelse

<div class="d-flex justify-content-center">
    {{ $games->links() }}
</div>

<div class="section-heading">
    <h2>Completed matches</h2>
</div>

@forelse ($games as $game)
    @php
        $date = \Carbon\Carbon::parse($game->start);
        $today = \Carbon\Carbon::today();
    @endphp
    @if ($game->finished)
    <a href="{{ route('games.show', $game)}}" style="text-decoration: none; color: black">
    <div class="match-container">
        <img class="team-logo" src={{$game->home_team->image ? ((Str::contains($game->home_team->image, 'https')) ?  $game->home_team->image : asset('storage/'.$game->home_team->image)) : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Home Team Image">
        <span class="team-name">{{ $game->home_team->name}} ({{ $game->home_team->shortname}})</span>
        @php
            $homeScore = 0;
            $awayScore = 0;
            foreach ($game->events as $event) {
                if ($event->type === 'goal') {
                    $playerTeam = $event->player->team_id;
                    if ($playerTeam === $game->home_team_id) {
                        $homeScore++;
                    } else {
                        $awayScore++;
                    }
                } elseif ($event->type === 'own_goal') {
                    $playerTeam = $event->player->team_id;
                    if ($playerTeam === $game->home_team_id) {
                        $awayScore++;
                    } else {
                        $homeScore++;
                    }
                }
            }
        @endphp
        <span class="score" >{{$homeScore}} - {{$awayScore}}</span>
        <img class="team-logo" src={{$game->away_team->image ? ((Str::contains($game->away_team->image, 'https')) ?  $game->away_team->image : asset('storage/'.$game->away_team->image)) : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Away Team Image">
        <span class="team-name">{{ $game->away_team->name }} ({{ $game->away_team->shortname}})</span>
        <span class="time">{{ $game->start }}</span>
    </div>
    </a>
    @endif
@empty
    <div class="col-12">
        <div class="alert alert-warning" role="alert">
            No matches available!
        </div>
    </div>
@endforelse


</div>
@endsection

