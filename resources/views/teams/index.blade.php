@extends('layouts.app')
@section('title', 'Teams')

<style>
    /* Base styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    h2{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    a:active {
        color: #00a651;
    }

    /* Main styles */
    .team-list {
        margin-top: 30px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .team-item {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        flex: 0 0 calc(33.33% - 20px);
        margin-right: 20px;
        width: 300px; /* Fixed width for the boxes */
    }

    /* Remove margin-right from last item in each row */
    .team-item:nth-child(3n) {
        margin-right: 0;
    }

    .team-item:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }

    .team-item img {
        max-width: 100%;
        margin-bottom: 10px;
    }

    .team-item h2 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    /* Media queries for responsiveness */
    @media only screen and (max-width: 767px) {
        .team-item {
            flex: 0 0 calc(50% - 20px);
            margin-right: 20px;
            margin-bottom: 20px;
        }
        .team-item:nth-child(2n) {
            margin-right: 0;
        }
    }

    @media only screen and (max-width: 479px) {
        .team-item {
            flex: 0 0 calc(100% - 20px);
            margin-right: 0;
            margin-bottom: 20px;
        }
    }

</style>

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-12 col-md-8">
            <h1>Teams</h1>
        </div>
        <div class="col-12 col-md-4">
            <div class="float-lg-end">

                <a href="{{ route('teams.create')}}" role="button" class="btn btn-sm btn-success mb-1"><i class="fas fa-plus-circle"></i> Create team</a>

            </div>
        </div>
    </div>

    <div class="row team-list">
        <div class="col-md-3 col-sm-6 col-xs-12">
            @forelse ($teams as $team)
            <div class="team-item">
                <a href="{{ route('teams.show', $team)}}">
                    <img src={{$team->image !== null ? $team->image : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Team Logo">
                    <h2>{{$team->name}} ({{$team->shortname}})</h2>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    No teams available!
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
