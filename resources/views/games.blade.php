<style>
	img {
		height: 50px;
		width: 50px;
		object-fit: contain;
        margin: 5px;
	}
</style>

@empty($games->toArray())
    <h1>Nincsenek mérkőzések</h1>
@else
    <h1>Mérkőzések</h1>
    <h2>Folyamatban lévő mérkőzések</h2>
    @foreach ($games as $game)
        @if (!$game->finished)
            <div>
                <img src={{$game->home_team->image !== null ? $game->home_team->image : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Home Team Image">
                <span>{{ $game->home_team->name}} ({{ $game->home_team->shortname}})</span>
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
                <span>{{$homeScore}} - {{$awayScore}}</span>
                <img src={{$game->away_team->image !== null ? $game->away_team->image : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Away Team Image">
                <span>{{ $game->away_team->name }} ({{ $game->away_team->shortname}})</span>
                <span>{{ $game->start }}</span>
            </div>
        @endif
    @endforeach

    <h2>Befejezett mérkőzések</h2>
    @foreach ($games as $game)
        @if ($game->finished)
        <div>
            <img src={{$game->home_team->image !== null ? $game->home_team->image : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Home Team Image">
            <span>{{ $game->home_team->name}} ({{ $game->home_team->shortname}})</span>
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
            <span>{{$homeScore}} - {{$awayScore}}</span>
            <img src={{$game->away_team->image !== null ? $game->away_team->image : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}} alt="Away Team Image">
            <span>{{ $game->away_team->name }} ({{ $game->away_team->shortname}})</span>
            <span>{{ $game->start }}</span>
        </div>
        @endif
    @endforeach
@endempty


