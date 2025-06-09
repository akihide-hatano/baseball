<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stadium;

class StadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stadium::create([
                        'name' => '東京ドーム',
            'location' => '東京都文京区',
            'capacity' => 45000,
            'build_year' => 1988,
        ]);

          Stadium::create([
            'name' => '甲子園球場',
            'location' => '兵庫県西宮市',
            'capacity' => 47508,
            'build_year' => 1924,
        ]);

        Stadium::create([
            'name' => '福岡PayPayドーム',
            'location' => '福岡県福岡市',
            'capacity' => 40178,
            'build_year' => 1993,
        ]);

        Stadium::create([
            'name' => 'マツダスタジアム',
            'location' => '広島県広島市',
            'capacity' => 33000,
            'build_year' => 2009,
        ]);

        Stadium::create([
            'name' => 'バンテリンドーム ナゴヤ',
            'location' => '愛知県名古屋市',
            'capacity' => 36374,
            'build_year' => 1997,
        ]);

        Stadium::create([
            'name' => '明治神宮野球場',
            'location' => '東京都新宿区',
            'capacity' => 37933,
            'build_year' => 1926,
        ]);

        Stadium::create([
            'name' => '楽天モバイルパーク宮城',
            'location' => '宮城県仙台市',
            'capacity' => 30508,
            'build_year' => 2005,
        ]);

        Stadium::create([
            'name' => 'ベルーナドーム',
            'location' => '埼玉県所沢市',
            'capacity' => 33921,
            'build_year' => 1979,
        ]);

        Stadium::create([
            'name' => 'ZOZOマリンスタジアム',
            'location' => '千葉県千葉市',
            'capacity' => 30348,
            'build_year' => 1990,
        ]);

        Stadium::create([
            'name' => 'エスコンフィールドHOKKAIDO',
            'location' => '北海道北広島市',
            'capacity' => 35000,
            'build_year' => 2023,
        ]);
    }
}
