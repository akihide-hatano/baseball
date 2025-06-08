<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'team_name' => '東京ジャイアンツ',
            'league' => 'セントラル・リーグ',
            'home_stadium' => '東京ドーム',
            'total_championships' => 22,
        ]);

        Team::create([
            'team_name' => '大阪タイガース',
            'league' => 'セントラル・リーグ',
            'home_stadium' => '甲子園球場',
            'total_championships' => 1,
        ]);

        Team::create([
            'team_name' => '福岡ホークス',
            'league' => 'パシフィック・リーグ',
            'home_stadium' => '福岡PayPayドーム',
            'total_championships' => 11,
        ]);

        // ここから新しい7つのチームを追加
        Team::create([
            'team_name' => '広島カープ',
            'league' => 'セントラル・リーグ',
            'home_stadium' => 'マツダスタジアム',
            'total_championships' => 3,
        ]);

        Team::create([
            'team_name' => '中日ドラゴンズ',
            'league' => 'セントラル・リーグ',
            'home_stadium' => 'バンテリンドーム ナゴヤ',
            'total_championships' => 2,
        ]);

        Team::create([
            'team_name' => 'ヤクルトスワローズ',
            'league' => 'セントラル・リーグ',
            'home_stadium' => '明治神宮野球場',
            'total_championships' => 9,
        ]);

        Team::create([
            'team_name' => '楽天ゴールデンイーグルス',
            'league' => 'パシフィック・リーグ',
            'home_stadium' => '楽天モバイルパーク宮城',
            'total_championships' => 1,
        ]);

        Team::create([
            'team_name' => '埼玉ライオンズ',
            'league' => 'パシフィック・リーグ',
            'home_stadium' => 'ベルーナドーム',
            'total_championships' => 13,
        ]);

        Team::create([
            'team_name' => '千葉ロッテマリンズ',
            'league' => 'パシフィック・リーグ',
            'home_stadium' => 'ZOZOマリンスタジアム',
            'total_championships' => 4,
        ]);

        Team::create([
            'team_name' => '日本ハムファイターズ',
            'league' => 'パシフィック・リーグ',
            'home_stadium' => 'エスコンフィールドHOKKAIDO',
            'total_championships' => 3,
        ]);
    }
}