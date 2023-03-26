<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(10)->create();

        \App\Models\Team::factory()->create([
            'name' => 'Barcelona',
            'shortname' => 'BAR',
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'Real Madrid',
            'shortname' => 'RM',
        ]);

        // $teams = \App\Models\Team::factory(3)->create();

        \App\Models\Player::factory(11)->create([
            'team_id' => 1,
        ]);

        \App\Models\Player::factory(11)->create([
            'team_id' => 2,
        ]);

        $teams = \App\Models\Team::factory(3)->create();

        for ($i=0; $i < 11; $i++) {
            $players = \App\Models\Player::factory()->create();
            $players->team()->associate($teams->random())->save();

        }

        for ($i=0; $i < 5; $i++) {
            $user =  \App\Models\User::factory()->create();
            $user->teams()->sync($teams->random());
        }

        \App\Models\Game::factory()->create([
            'home_team_id' => 1,
            'away_team_id' => 2,
        ]);


        \App\Models\Event::factory()->create([
            'type' => 'goal',
            'minute' => 2,
            'game_id' => 1,
            'player_id' => 11
        ]);



    }
}
