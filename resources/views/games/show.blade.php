@extends('layouts.app')
@section('title', 'View game: ')

<style>
    h4 {
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 1rem;
    }

    th {
        text-align: center;
        size: 20%;
        font-weight: bold;
        border: 1px solid #ddd;
        background-color: #00a651;
        color: white;
    }

    td {
        padding: 8px;
        border: 1px solid #ddd;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    td:nth-child(1) {
        width: 10%;
    }

    td:nth-child(2) {
        width: 20%;
    }

    td:nth-child(3) {
        width: 30%;
    }

    td:nth-child(4) {
        width: 30%;
    }

    td:nth-child(5), td:nth-child(6) {
        width: 5%;
        text-align: center;
    }
</style>

@php
    $date = \Carbon\Carbon::parse($game->start);
    $today = \Carbon\Carbon::today();
@endphp

@section('content')
<div class="container">
    @if (Session::has('game_created'))
            <div class="alert alert-primary">
                <span>You have successfully created this game: </span>
            </div>
    @endif
    <div class="row justify-content-between">
        <div class="col-12 col-md-8">
            <h1>Details: {{$game->home_team->name}} vs {{$game->away_team->name}} </h1>
            <a href="{{ route('games.index')}}"><i class="fas fa-long-arrow-alt-left"></i> Back to the Matches page</a>
        </div>
        <div class="col-12 col-md-4">
            <div class="float-lg-end">
                @can('update', $game)
                    <a role="button" class="btn btn-sm btn-primary" href="{{ route('games.edit', $game) }}"><i class="far fa-edit"></i>Edit match</a>
                @endcan

                @if (!$game->finished && $date->lt($today))
                    @can('create', App\Models\Event::class)
                        <a href="{{ route('events.create')}}" role="button" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Create Event</a>
                    @endcan
                @endif

                @can('delete', $game)
                    @if (count($game->events) === 0)
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal"><i class="far fa-trash-alt">
                            <span></i> Delete match</span>
                        </button>
                    @endif
                @endcan
            </div>
        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="delete-confirm-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the game between {{$game->home_team->name}} vs {{$game->away_team->name}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button
                        type="button"
                        class="btn btn-danger"
                        onclick="document.getElementById('delete-game-form').submit();">
                        Yes, delete this game
                    </button>

                    <form id="delete-game-form" action="{{ route('games.destroy', $game)}}" method="POST" class="d-none">
                        @method('DELETE')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

          <div class="d-flex justify-content-center align-items-center">
            {{-- <div class="logo mx-4">
              <img
                src="{{$game->home_team->image !== null ? $game->home_team->image : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}}"
                alt="Home Team Logo"
                class="img-fluid"
                width="150px"
              />
            </div> --}}
            <div class="team mx-4">
              <h3>{{$game->home_team->name}} vs {{$game->away_team->name}}</h3>
            </div>
            {{-- <div class="logo mx-4">
              <img
                src="{{$game->away_team->image !== null ? $game->away_team->image : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}}"
                alt="Away Team Logo"
                class="img-fluid"
                width="150px"
              />
            </div> --}}
          </div>

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
            $result = "$homeScore - $awayScore";
        @endphp

          <h4 class="result text-center">{{($game->finished || (!$game->finished && $date->lt($today))) ? $result : ""}}</h4>
          <h4 class="text-center my-3">Match Date:  <i>{{ $game->start }}</i></h4>
          @if ($game->finished || (!$game->finished && $date->lt($today)))
          <h4>Match Events</h4>
              <table>
                <tr>
                    <th>Minute</th>
                    <th>Type of Event</th>
                    <th>Name of the Player</th>
                    <th>Team of the Player</th>
                    @can('update', $event)
                        @if (!$game->finished)
                            <th> </th>
                            <th> </th>
                        @endif
                    @endcan
                </tr>
                    @foreach ($game->events->sortBy('minute') as $event)
                        <tr>
                            <td>{{$event->minute}}"</td>
                            <td>
                                {{$event->type == 'goal' ? 'Goal' : ($event->type == 'own_goal' ? 'Own Goal' : ($event->type == 'yellow_card' ? 'Yellow Card' : ($event->type == 'red_card' ? 'Red Card' : 'Unknown'))) }}
                            </td>
                            <td>{{$event->player->name}}</td>
                            <td>{{$event->player->team->name}}</td>
                            @if (!$game->finished)
                                @can('update', $event)
                                <td><button type="button" class="btn btn-primary">Edit</button></td>
                                @endcan
                                @can('delete', $event)
                                    <td><button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal2"><i class="far fa-trash-alt">
                                        Delete
                                    </button></td>
                                @endcan
                            @endif
                            <div class="modal fade" id="delete-confirm-modal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Confirm delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the event?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form id="delete-event-form" action="{{ route('events.destroy', $event)}}" method="POST" class="d-none">
                                                @method('DELETE')
                                                @csrf

                                                <button
                                                type="submit"
                                                class="btn btn-danger">
                                                Yes, delete this event
                                            </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
              </table>
          @endif

</div>




</div>
@endsection
