<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // デフォルトのユーザー作成（必要であれば残す）
        User::factory(10)->create(); // 10人のユーザーをファクトリーで作成する場合
        $this->call([
            StadiumSeeder::class,
            TeamSeeder::class,     // TeamSeeder を呼び出す
            PositionSeeder::class, // PositionSeeder を呼び出す
            PlayerSeeder::class,   // PlayerSeeder を呼び出す
        ]);
    }
}