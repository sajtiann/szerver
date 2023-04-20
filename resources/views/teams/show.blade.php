@extends('layouts.app')
@section('title', 'View Team: ')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-12 col-md-8">
            <h1>Details: {{$team->name}} </h1>
        </div>
        <div class="col-12 col-md-4">
            <div class="float-lg-end">

                <a href="{{ route('players.create')}}" role="button" class="btn btn-sm btn-success mb-1"><i class="fas fa-plus-circle"></i> Add Player</a>

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
                @foreach ($team->players as $player)
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
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
