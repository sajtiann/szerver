<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model {
    use HasFactory;

    public function players() {
        return $this->hasMany(Player::class);
    }

    public function game1() {
        return $this->belongsTo(Game::class, 'home_team_id');
    }

    public function game2() {
        return $this->belongsTo(Game::class, 'away_team_id');
    }

}
