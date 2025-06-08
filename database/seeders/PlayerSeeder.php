<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;
use App\Models\Team;
use App\Models\Position;
use Faker\Factory as Faker; // Fakerライブラリを使用してダミーデータを生成

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ja_JP'); // 日本語のダミーデータを生成

        // データベースからすべてのチームとポジションのデータを取得
        $teams = Team::all();
        $positions = Position::all();

        // チームまたはポジションのデータがない場合は、選手データを作成せずに終了
        if ($teams->isEmpty() || $positions->isEmpty()) {
            $this->command->info('チームまたはポジションのデータがないため、選手データは作成されません。');
            return;
        }

        // 選手データを作成（例として100人）
        for ($i = 0; $i < 100; $i++) { // 選手の数を100人に設定
            $player = Player::create([
                'team_id' => $teams->random()->id, // 既存のチームからランダムに割り当て
                'name' => $faker->name, // ダミーの選手名
                'jersey_number' => $faker->unique()->numberBetween(1, 150), // 1〜150の重複しない背番号
                'date_of_birth' => $faker->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d'), // 18歳から35歳の間
                'height' => $faker->numberBetween(170, 190), // 170cmから190cm
                'weight' => $faker->numberBetween(70, 95), // 70kgから95kg
                'status' => $faker->randomElement(['現役', '二軍', '故障者リスト']), // 状態をランダムに
            ]);

            // 選手にランダムなポジションを1〜3つ割り当てる (多対多のリレーション)
            // position_idの配列を取得し、attachでまとめて割り当てる
            $player->positions()->attach(
                $positions->random(mt_rand(1, 3))->pluck('id')->toArray()
            );
        }

        $this->command->info('100人の選手データを作成しました。');
    }
}