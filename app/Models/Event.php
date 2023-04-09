<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    use HasFactory;

    public static $types = ['goal', 'own_goal', 'yellow_card', 'red_card'];

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function player() {
        return $this->belongsTo(Player::class);
    }
}
