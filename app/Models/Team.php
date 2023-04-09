<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model {
    use HasFactory;

    public function players() {
        return $this->hasMany(Player::class);
    }

    public function gameHome() {
        return $this->hasOne(Game::class, 'home_team_id');
    }

    public function gameAway() {
        return $this->hasOne(Game::class, 'away_team_id');
    }

    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
