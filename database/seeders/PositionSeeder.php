<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            'ピッチャー', 'キャッチャー', 'ファースト', 'セカンド', 'ショート',
            'サード', 'レフト', 'センター', 'ライト', '指名打者'
        ];

        foreach ($positions as $position) {
            Position::create(['name' => $position]);
        }
    }
}