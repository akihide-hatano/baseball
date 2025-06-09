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
        'stadium_id', // ★ 2. ここに stadium_id があり、カンマも正しく付いているか確認！
    ];

    // Player リレーション（もしあれば）
    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    /**
     * このチームが所属するスタジアムを取得する (1対1の関係)
     */
    public function stadium(): BelongsTo // ★ 3. メソッド名、型ヒント BelongsTo が正しいか確認！
    {
        // ★ 4. return $this->belongsTo(Stadium::class); が正しいか確認！
        //      もし、外部キー名が 'stadium_id' 以外の場合は、
        //      return $this->belongsTo(Stadium::class, '外部キー名'); のように記述
        //      しかし、今回はデフォルトの 'stadium_id' なので、現状のままでOKのはず
        return $this->belongsTo(Stadium::class);
    }
}