<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasMany;

    protected $fillable=[
        'team_name',
        'league',
        'home_stadium',
        'total_championships',
    ];

    public function players():HasMany{
        return $this->hasMany(Player::class);
    }
}
