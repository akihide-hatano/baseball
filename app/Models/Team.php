<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // ★ 1. この use 文が正しいか確認！
use Illuminate\Database\Eloquent\Relations\HasMany; // Player リレーションがあれば

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_name',
        'league',
        'total_championships',
        'stadium_id',
    ];

    // Player リレーション（もしあれば）
    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function stadium(): BelongsTo // ★ 3. メソッド名、型ヒント BelongsTo が正しいか確認！
    {
        return $this->belongsTo(Stadium::class);
    }
}