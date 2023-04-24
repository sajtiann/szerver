@extends('layouts.app')
@section('title', 'View Team: ')

@section('content')
<div class="container">
    @if (Session::has('team_created'))
        <div class="alert alert-primary">
           <span>You have successfully created this team:</span>
       </div>
    @endif
    <div class="row justify-content-between">
        <div class="col-12 col-md-8">
            <h1>Details: {{$team->name}} </h1>
        </div>

        <div class="col-12 col-md-4">
            <div class="float-lg-end">

                @can('create', App\Models\Player::class)
                    <a href="{{ route('players.create')}}" role="button" class="btn btn-sm btn-success "><i class="fas fa-plus-circle"></i> Add Player</a>
                @endcan

                @can('update', $team)
                    <a role="button" class="btn btn-sm btn-primary" href="{{ route('teams.edit', $team) }}"><i class="far fa-edit"></i>Edit team</a>
                @endcan
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <h4>The Team's Matches</h4>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Home team</th>
                    <th scope="col">Away team</th>
                    <th scope="col">Score</th>
                    <th scope="col">Date of the Match</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $hasMatches = false;
                @endphp
                @foreach ($games->sortBy('start') as $game)
                    @if ($game->away_team_id === $team->id || $game->home_team_id === $team->id)
                        @php
                        $hasMatches = true;
                        $date = \Carbon\Carbon::parse($game->start);
                        $today = \Carbon\Carbon::today();
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
                        $result = "$homeScore - $awayScore";
                        @endphp
                            <tr>
                                <td>{{$game->home_team->name}}</td>
                                <td>{{$game->away_team->name}}</td>
                                <td>{{($game->finished || (!$game->finished && $date->lt($today))) ? $result : ""}}</td>
                                <td>{{$game->start}}</td>
                            </tr>
                    @endif
                @endforeach
                    @if (!$hasMatches)
                        <tr>
                            <td colspan="4" style="text-align:center">No matches available for this team</td>
                        </tr>
                    @endif
            </tbody>
        </table>

        <div class="d-flex justify-content-center align-items-center">
            <h4>The Team's Players</h4>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Goals</th>
                    <th scope="col">Own Goals</th>
                    <th scope="col">Yellow Cards</th>
                    <th scope="col">Red Cards</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($team->players as $player)
                    @php
                    $goals = 0;
                    $own_goals = 0;
                    $yellow_cards = 0;
                    $red_cards = 0;
                    foreach ($player->events as $event){
                        if ($event->type === 'goal') {
                            $goals++;
                        } elseif ($event->type === 'own_goal') {
                            $own_goals++;
                        } elseif ($event->type === 'yellow_card') {
                            $yellow_cards++;
                        } elseif ($event->type === 'red_card') {
                            $red_cards++;
                        }
                    }
                    @endphp
                    <tr>
                        <td>{{$player->name}}</td>
                        <td>{{$player->birthdate}}</td>
                        <td>{{$goals}}</td>
                        <td>{{$own_goals}}</td>
                        <td>{{$yellow_cards}}</td>
                        <td>{{$red_cards}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center">No players available for this team</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
