<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Stadium; // ★ Stadium モデルをインポート

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ★ 各スタジアムのIDを事前に取得しておく
        // この部分を追加または確認してください
        $tokyoDomeId = Stadium::where('name', '東京ドーム')->value('id');
        $koshienId = Stadium::where('name', '甲子園球場')->value('id');
        $payPayDomeId = Stadium::where('name', '福岡PayPayドーム')->value('id');
        $mazdaStadiumId = Stadium::where('name', 'マツダスタジアム')->value('id');
        $vantelinDomeId = Stadium::where('name', 'バンテリンドーム ナゴヤ')->value('id');
        $jinguStadiumId = Stadium::where('name', '明治神宮野球場')->value('id');
        $rakutenParkId = Stadium::where('name', '楽天モバイルパーク宮城')->value('id');
        $bellunaDomeId = Stadium::where('name', 'ベルーナドーム')->value('id');
        $zozoMarineId = Stadium::where('name', 'ZOZOマリンスタジアム')->value('id');
        $esconFieldId = Stadium::where('name', 'エスコンフィールドHOKKAIDO')->value('id');


        Team::create([
            'team_name' => '読売ジャイアンツ',
            'league' => 'セントラル・リーグ',
            'stadium_id' => $tokyoDomeId, // ★ home_stadium の代わりに stadium_id を使う
            'total_championships' => 22,
        ]);

        Team::create([
            'team_name' => '阪神タイガース',
            'league' => 'セントラル・リーグ',
            'stadium_id' => $koshienId, // ★ home_stadium の代わりに stadium_id を使う
            'total_championships' => 1,
        ]);

        Team::create([
            'team_name' => '福岡ソフトバンクホークス',
            'league' => 'パシフィック・リーグ',
            'stadium_id' => $payPayDomeId, // ★ home_stadium の代わりに stadium_id を使う
            'total_championships' => 11,
        ]);

        // ここから新しい7つのチームを追加
        Team::create([
            'team_name' => '広島東洋カープ',
            'league' => 'セントラル・リーグ',
            'stadium_id' => $mazdaStadiumId,
            'total_championships' => 3,
        ]);

        Team::create([
            'team_name' => '中日ドラゴンズ',
            'league' => 'セントラル・リーグ',
            'stadium_id' => $vantelinDomeId,
            'total_championships' => 2,
        ]);

        Team::create([
            'team_name' => '東京ヤクルトスワローズ',
            'league' => 'セントラル・リーグ',
            'stadium_id' => $jinguStadiumId,
            'total_championships' => 9,
        ]);

        Team::create([
            'team_name' => '東北楽天ゴールデンイーグルス',
            'league' => 'パシフィック・リーグ',
            'stadium_id' => $rakutenParkId,
            'total_championships' => 1,
        ]);

        Team::create([
            'team_name' => '埼玉西武ライオンズ',
            'league' => 'パシフィック・リーグ',
            'stadium_id' => $bellunaDomeId,
            'total_championships' => 13,
        ]);

        Team::create([
            'team_name' => '千葉ロッテマリーンズ',
            'league' => 'パシフィック・リーグ',
            'stadium_id' => $zozoMarineId,
            'total_championships' => 4,
        ]);

        Team::create([
            'team_name' => '北海道日本ハムファイターズ',
            'league' => 'パシフィック・リーグ',
            'stadium_id' => $esconFieldId,
            'total_championships' => 3,
        ]);
    }
}