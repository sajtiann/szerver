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
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\Player::factory(22)->create();

        \App\Models\Team::factory()->create([
            'name' => 'Barcelona',
            'shortname' => 'BAR',
        ]);

        \App\Models\Team::factory()->create([
            'name' => 'Real Madrid',
            'shortname' => 'RM',
        ]);

        \App\Models\Event::factory()->create([
            'type' => 'goal',
            'minute' => 2,
        ]);


        \App\Models\Game::factory(1)->create();
    }
}
