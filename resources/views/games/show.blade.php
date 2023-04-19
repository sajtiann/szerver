@extends('layouts.app')
{{-- TODO: Post title --}}
@section('title', 'View game: ')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-12 col-md-8">
            <h1>Details: {{$game->home_team->name}} vs {{$game->away_team->name}} </h1>
        </div>
        <div class="col-12 col-md-4">
            <div class="float-lg-end">

                <a href="{{ route('events.create')}}" role="button" class="btn btn-sm btn-success mb-1"><i class="fas fa-plus-circle"></i> Create Event</a>

            </div>
        </div>
    </div>
          <div class="d-flex justify-content-center align-items-center">
            <div class="logo mx-4">
              <img
                src="{{$game->home_team->image !== null ? $game->home_team->image : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}}"
                alt="Home Team Logo"
                class="img-fluid"
                width="150px"
              />
            </div>
            <div class="team mx-4">
              <h3>{{$game->home_team->name}}</h3>
              <p>vs</p>
              <h3>{{$game->away_team->name}}</h3>
            </div>
            <div class="logo mx-4">
              <img
                src="{{$game->away_team->image !== null ? $game->away_team->image : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}}"
                alt="Away Team Logo"
                class="img-fluid"
                width="150px"
              />
            </div>
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
            $date = \Carbon\Carbon::parse($game->start);
            $today = \Carbon\Carbon::today();
        @endphp

          <p class="result text-center">{{($game->finished || (!$game->finished && $date->lt($today))) ? $result : ""}}</p>
          <p class="text-center my-3">Match Date:  {{ $game->start }}</p>
          @if ($game->finished || (!$game->finished && $date->lt($today)))
          <h4>Match Events</h4>
              <table>
                    @foreach ($game->events->sortBy('minute') as $event)
                        <tr>
                            <td>Minute: {{$event->minute}}</td>
                            <td>{{$event->type}}</td>
                            <td>{{$event->player->name}}</td>
                            <td>{{$event->player->team->name}}</td>
                            <td>Edit</td>
                            <td>Delete</td>
                        </tr>
                    @endforeach
              </table>
          @endif

        {{-- TODO: Link --}}
        <a href="{{ route('games.index')}}"><i class="fas fa-long-arrow-alt-left"></i> Back to the homepage</a>


    {{-- <div class="col-12 col-md-4">
        <div class="float-lg-end">
            <a role="button" class="btn btn-sm btn-primary" href="#"><i class="far fa-edit"></i> Edit post</a>

            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal"><i class="far fa-trash-alt">
                <span></i> Delete post</span>
            </button>

        </div>
    </div> --}}
</div>

<!-- Modal -->
{{--
<div class="modal fade" id="delete-confirm-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Confirm delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- TODO: Title
                Are you sure you want to delete post <strong>N/A</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button
                    type="button"
                    class="btn btn-danger"
                    onclick="document.getElementById('delete-post-form').submit();"
                >
                    Yes, delete this post
                </button>

                {{-- TODO: Route, directives
                <form id="delete-post-form" action="#" method="POST" class="d-none">

                </form>
            </div>
        </div>
    </div>
</div>
--}}

</div>
@endsection
