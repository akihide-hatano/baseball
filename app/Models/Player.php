<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'jersey_number',
        'date_of_birth',
        'height',
        'weight',
        'status',
    ];

    /**
     * Get the team that owns the player.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * The positions that belong to the player.
     */
    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'player_position');
    }
}