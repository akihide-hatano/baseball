<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Stadium extends Model
{
    use HasFactory;

    protected $table = 'stadiums'; // これを忘れずに！

    protected $fillable =[
        'name',
        'location',
        'capacity',
        'build_year',
    ];

    // このスタジアムを本拠地とする「単一の」チームを定義する
    // メソッド名を「team」と単数形にする
    public function team():HasOne // メソッド名を修正
    {
        // Stadium モデルは一つの Team を「持つ」 (hasOne)
        // Team モデル側で外部キー stadium_id が使われていることを想定
        return $this->hasOne(Team::class, 'stadium_id'); // もしTeamsテーブルの外部キーが home_stadium_id ならば 'home_stadium_id'
    }
}