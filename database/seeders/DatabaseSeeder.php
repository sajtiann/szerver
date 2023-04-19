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
        // ---- USERS ----

        for ($i = 1; $i <= 10; $i++) {
            \App\Models\User::factory()->create([
                'name' => "User{$i}",
                'email' => "user{$i}@szerveroldali.hu",
            ]);
        }

        \App\Models\User::factory()->create([
            'name' => "Admin",
            'email' => "admin@szerveroldali.hu",
            'is_admin' => true,
            'password' => bcrypt('adminpwd'),
        ]);

        // ---- TEAMS ----

        \App\Models\Team::factory()->create([
            'name' => 'Barcelona',
            'shortname' => 'BAR',
            'image' => 'https://api.efootball.pro/uploads/d4dd393dd18949fe811619bbf00bd3f4.png'
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'Manchester United',
            'shortname' => 'MUFC',
            'image' => 'https://api.efootball.pro/uploads/5a2c0ea4697a4ad5a954d33b97644368.png'
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'FC Bayern Munich',
            'shortname' => 'FCB',
            'image' => 'https://api.efootball.pro/uploads/65cabe00da0b4f7999cbecf05429ea1e.png'
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'Paris Saint-Germain',
            'shortname' => 'PSG',
            'image' => 'https://upload.wikimedia.org/wikipedia/en/thumb/a/a7/Paris_Saint-Germain_F.C..svg/1200px-Paris_Saint-Germain_F.C..svg.png'
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'AC Milan',
            'shortname' => 'ACM',
            'image' => 'https://api.efootball.pro/uploads/31f4fe4cff9d4e90bd705ade9e248b00.png'
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'Arsenal',
            'shortname' => 'ARS',
            'image' => 'https://api.efootball.pro/uploads/4918845fef864284b7e0d1fe0e670b9f.png'
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'Ferencvaros TC',
            'shortname' => 'FTC',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/Ferencvarosi_TC.svg/1200px-Ferencvarosi_TC.svg.png'
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'Unicorn FC',
            'shortname' => 'UFC',
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'Banana FC',
            'shortname' => 'BFC',
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'Peanut FC',
            'shortname' => 'PFC',
        ]);

        // ---- PLAYERS ----

        \App\Models\Player::factory(6)->create([
            'team_id' => 1,
        ]);

        \App\Models\Player::factory(6)->create([
            'team_id' => 2,
        ]);
        \App\Models\Player::factory(6)->create([
            'team_id' => 3,
        ]);

        \App\Models\Player::factory(6)->create([
            'team_id' => 4,
        ]);

        \App\Models\Player::factory(6)->create([
            'team_id' => 5,
        ]);

        \App\Models\Player::factory(6)->create([
            'team_id' => 6,
        ]);

        \App\Models\Player::factory(6)->create([
            'team_id' => 7,
        ]);

        \App\Models\Player::factory(6)->create([
            'team_id' => 8,
        ]);

        \App\Models\Player::factory(6)->create([
            'team_id' => 9,
        ]);

        \App\Models\Player::factory(6)->create([
            'team_id' => 10,
        ]);

        \App\Models\Player::factory(3)->create();

        // ---- GAMES ----

        // -- ONGOING --
        \App\Models\Game::factory()->create([
            'home_team_id' => 6,
            'away_team_id' => 2,
        ]);

        \App\Models\Game::factory()->create([
            'home_team_id' => 10,
            'away_team_id' => 9,
        ]);

        \App\Models\Game::factory()->create([
            'home_team_id' => 4,
            'away_team_id' => 7,
        ]);

        // -- UPCOMING --
        \App\Models\Game::factory()->create([
            'home_team_id' => 1,
            'away_team_id' => 5,
            'start' => '2023-09-03 12:00:00'
        ]);

        \App\Models\Game::factory()->create([
            'home_team_id' => 3,
            'away_team_id' => 4,
            'start' => '2023-10-03 14:00:00'
        ]);

        \App\Models\Game::factory()->create([
            'home_team_id' => 5,
            'away_team_id' => 7,
            'start' => '2023-11-03 16:00:00'
        ]);

        \App\Models\Game::factory()->create([
            'home_team_id' => 8,
            'away_team_id' => 1,
            'start' => '2023-12-03 18:00:00'
        ]);

        // -- COMPLETED --
        \App\Models\Game::factory()->create([
            'home_team_id' => 7,
            'away_team_id' => 3,
            'finished' => true,
            'start' => '2020-12-03 18:00:00'
        ]);

        \App\Models\Game::factory()->create([
            'home_team_id' => 4,
            'away_team_id' => 9,
            'finished' => true,
            'start' => '2020-11-03 16:00:00'

        ]);

        \App\Models\Game::factory()->create([
            'home_team_id' => 2,
            'away_team_id' => 5,
            'finished' => true,
            'start' => '2020-09-03 11:30:00'
        ]);

        \App\Models\Game::factory()->create([
            'home_team_id' => 6,
            'away_team_id' => 8,
            'finished' => true,
            'start' => '2020-09-27 9:00:00'
        ]);

        \App\Models\Game::factory()->create([
            'home_team_id' => 1,
            'away_team_id' => 10,
            'finished' => true,
            'start' => '2020-07-07 7:00:00'
        ]);

        // ---- EVENTS ----

        // -- ONGOING --
        \App\Models\Event::factory()->create([
            'type' => 'goal',
            'minute' => 2,
            'game_id' => 1,
            'player_id' => 8,
        ]);

        \App\Models\Event::factory()->create([
            'type' => 'own_goal',
            'minute' => 12,
            'game_id' => 1,
            'player_id' => 31,
        ]);

        \App\Models\Event::factory()->create([
            'type' => 'yellow_card',
            'minute' => 78,
            'game_id' => 1,
            'player_id' => 9,
        ]);

        \App\Models\Event::factory()->create([
            'type' => 'red_card',
            'minute' => 89,
            'game_id' => 1,
            'player_id' => 36,
        ]);

        \App\Models\Event::factory()->create([
            'game_id' => 2,
            'minute' => 89,
            'player_id' => 60,
            'type' => 'own_goal',
        ]);

        \App\Models\Event::factory()->create([
            'game_id' => 3,
            'player_id' => 20,
            'type' => 'red_card',
        ]);

        \App\Models\Event::factory(10)->create([
            'game_id' => 3,
            'player_id' => 40,
            'type' => 'goal',
        ]);

        // -- COMPLETED --

        \App\Models\Event::factory(2)->create([
            'game_id' => 8,
            'player_id' => 15,
            'type' => 'goal',
        ]);

        \App\Models\Event::factory(2)->create([
            'game_id' => 9,
            'player_id' => 7,
            'type' => 'own_goal',
        ]);

        \App\Models\Event::factory()->create([
            'game_id' => 10,
            'player_id' => 36,
            'type' => 'red_card',
        ]);

        \App\Models\Event::factory()->create([
            'game_id' => 10,
            'player_id' => 48,
            'type' => 'own_goal',
        ]);

        \App\Models\Event::factory(3)->create([
            'game_id' => 12,
            'player_id' => 1,
            'type' => 'goal',
        ]);

        \App\Models\Event::factory()->create([
            'game_id' => 12,
            'player_id' => 1,
            'type' => 'yellow_card',
        ]);
    }
}
