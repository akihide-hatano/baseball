<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;
use App\Models\Team;
use App\Models\Position;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ja_JP');

        $teams = Team::all();
        $positions = Position::all();

        if ($teams->isEmpty() || $positions->isEmpty()) {
            $this->command->info('チームまたはポジションのデータがないため、選手データは作成されません。');
            return;
        }

        // チームIDを事前に取得しておくと便利
        $giantsId = $teams->firstWhere('team_name', '読売ジャイアンツ')?->id;
        $eaglesId = $teams->firstWhere('team_name', '東北楽天ゴールデンイーグルス')?->id;
        $tigersId = $teams->firstWhere('team_name', '阪神タイガース')?->id;
        $baystarsId = $teams->firstWhere('team_name', '横浜DeNAベイスターズ')?->id;
        $carpId = $teams->firstWhere('team_name', '広島東洋カープ')?->id;
        $dragonsId = $teams->firstWhere('team_name', '中日ドラゴンズ')?->id;
        $swallowsId = $teams->firstWhere('team_name', '東京ヤクルトスワローズ')?->id;
        $buffaloesId = $teams->firstWhere('team_name', 'オリックス・バファローズ')?->id;
        $marinesId = $teams->firstWhere('team_name', '千葉ロッテマリーンズ')?->id;
        $hawksId = $teams->firstWhere('team_name', '福岡ソフトバンクホークス')?->id;
        $fightersId = $teams->firstWhere('team_name', '北海道日本ハムファイターズ')?->id;
        $lionsId = $teams->firstWhere('team_name', '埼玉西武ライオンズ')?->id;

        // 都道府県リスト
        $prefectures = [
            '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
            '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
            '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県',
            '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県',
            '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県',
            '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県',
            '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
        ];

        // Playerテーブルに挿入するデータを格納する配列
        $playersToInsert = [];
        // player_position中間テーブルに挿入するデータを格納する配列
        $playerPositionToInsert = [];

        // 現在のタイムスタンプ
        $now = now();

        // --- 具体的な選手のデータ例 (2人) ---
        // 坂本勇人選手の具体的な成績データ（画像に合わせて調整）
        if ($giantsId) {
            $sakamotoCareerStats = [
                "年度別成績" => [
                    [
                        "年" => 2024, "球団名" => "読売ジャイアンツ", "球団ID" => $giantsId, "タイプ" => "打撃",
                        "データ" => [
                            "試合" => 135, "打率" => ".305", "本塁打" => 28, "打点" => 85, "盗塁" => 5,
                            "打席" => 500, "打数" => 450, "安打" => 137, "二塁打" => 30, "三塁打" => 3,
                            "三振" => 80, "四球" => 50, "死球" => 5, "犠打" => 10, "犠飛" => 3,
                            "盗塁死" => 2, "併殺打" => 15, "得点圏打率" => ".320", "出塁率" => ".380", "長打率" => ".550", "OPS" => ".930", "失策" => 10
                        ]
                    ],
                    [
                        "年" => 2023, "球団名" => "読売ジャイアンツ", "球団ID" => $giantsId, "タイプ" => "打撃",
                        "データ" => [
                            "試合" => 120, "打率" => ".298", "本塁打" => 22, "打点" => 78, "盗塁" => 3,
                            "打席" => 450, "打数" => 400, "安打" => 119, "二塁打" => 25, "三塁打" => 2,
                            "三振" => 70, "四球" => 45, "死球" => 3, "犠打" => 8, "犠飛" => 2,
                            "盗塁死" => 1, "併殺打" => 12, "得点圏打率" => ".310", "出塁率" => ".360", "長打率" => ".520", "OPS" => ".880", "失策" => 8
                        ]
                    ],
                    [
                        "年" => 2022, "球団名" => "読売ジャイアンツ", "球団ID" => $giantsId, "タイプ" => "打撃",
                        "データ" => [
                            "試合" => 100, "打率" => ".270", "本塁打" => 15, "打点" => 60, "盗塁" => 2,
                            "打席" => 380, "打数" => 350, "安打" => 95, "二塁打" => 20, "三塁打" => 1,
                            "三振" => 65, "四球" => 30, "死球" => 2, "犠打" => 5, "犠飛" => 1,
                            "盗塁死" => 0, "併殺打" => 10, "得点圏打率" => ".280", "出塁率" => ".330", "長打率" => ".480", "OPS" => ".810", "失策" => 5
                        ]
                    ],
                    [
                        "年" => 2021, "球団名" => "読売ジャイアンツ", "球団ID" => $giantsId, "タイプ" => "打撃",
                        "データ" => [
                            "試合" => 130, "打率" => ".315", "本塁打" => 35, "打点" => 105, "盗塁" => 7,
                            "打席" => 520, "打数" => 480, "安打" => 151, "二塁打" => 35, "三塁打" => 4,
                            "三振" => 90, "四球" => 60, "死球" => 6, "犠打" => 12, "犠飛" => 4,
                            "盗塁死" => 3, "併殺打" => 18, "得点圏打率" => ".330", "出塁率" => ".390", "長打率" => ".600", "OPS" => ".990", "失策" => 12
                        ]
                    ],
                    [
                        "年" => 2020, "球団名" => "読売ジャイアンツ", "球団ID" => $giantsId, "タイプ" => "打撃",
                        "データ" => [
                            "試合" => 110, "打率" => ".290", "本塁打" => 20, "打点" => 65, "盗塁" => 4,
                            "打席" => 420, "打数" => 380, "安打" => 110, "二塁打" => 25, "三塁打" => 2,
                            "三振" => 75, "四球" => 40, "死球" => 4, "犠打" => 7, "犠飛" => 2,
                            "盗塁死" => 1, "併殺打" => 14, "得点圏打率" => ".300", "出塁率" => ".350", "長打率" => ".500", "OPS" => ".850", "失策" => 7
                        ]
                    ]
                ],
                "通算成績" => [
                    "タイプ" => "打撃",
                    "データ" => ["打率" => ".300", "本塁打" => 450, "打点" => 1500, "盗塁" => 150]
                ]
            ];

            $playersToInsert[] = [
                'id' => 1,
                'team_id' => $giantsId,
                'name' => '坂本 勇人',
                'jersey_number' => 6,
                'date_of_birth' => '1988-12-14',
                'height' => 186,
                'weight' => 86,
                'status' => '現役',
                'specialty' => '広角打法',
                'hometown' => '兵庫県伊丹市',
                'description' => '読売ジャイアンツのキャプテンであり、球界を代表する遊撃手。安定した守備と勝負強い打撃が魅力で、数々のタイトルを獲得している。WBCにも出場し、チームの勝利に貢献。',
                'career_stats' => json_encode($sakamotoCareerStats),
                'created_at' => $now,
                'updated_at' => $now,
            ];
            $playerPositionToInsert[] = ['player_id' => 1, 'position_id' => $positions->firstWhere('name', 'ショート')?->id, 'created_at' => $now, 'updated_at' => $now];
            $playerPositionToInsert[] = ['player_id' => 1, 'position_id' => $positions->firstWhere('name', 'セカンド')?->id, 'created_at' => $now, 'updated_at' => $now];
        }

        if ($eaglesId) {
            // 田中将大選手の具体的な成績データ
            $tanakaCareerStats = [
                "年度別成績" => [
                    [
                        "年" => 2024, "球団名" => "東北楽天ゴールデンイーグルス", "球団ID" => $eaglesId, "タイプ" => "投球",
                        "データ" => ["試合" => 25, "防御率" => "3.10", "勝利" => 10, "敗北" => 8, "奪三振" => 150, "投球回" => "160.0", "自責点" => 55, "被安打" => 140, "与四球" => 30, "与死球" => 5, "失点" => 60]
                    ],
                    [
                        "年" => 2023, "球団名" => "東北楽天ゴールデンイーグルス", "球団ID" => $eaglesId, "タイプ" => "投球",
                        "データ" => ["試合" => 20, "防御率" => "3.50", "勝利" => 8, "敗北" => 10, "奪三振" => 120, "投球回" => "140.0", "自責点" => 54, "被安打" => 130, "与四球" => 25, "与死球" => 3, "失点" => 58]
                    ],
                    [
                        "年" => 2022, "球団名" => "東北楽天ゴールデンイーグルス", "球団ID" => $eaglesId, "タイプ" => "投球",
                        "データ" => ["試合" => 25, "防御率" => "2.80", "勝利" => 13, "敗北" => 7, "奪三振" => 160, "投球回" => "175.0", "自責点" => 54, "被安打" => 150, "与四球" => 35, "与死球" => 4, "失点" => 58]
                    ],
                    [
                        "年" => 2021, "球団名" => "東北楽天ゴールデンイーグルス", "球団ID" => $eaglesId, "タイプ" => "投球",
                        "データ" => ["試合" => 23, "防御率" => "2.90", "勝利" => 11, "敗北" => 6, "奪三振" => 140, "投球回" => "150.0", "自責点" => 48, "被安打" => 130, "与四球" => 28, "与死球" => 2, "失点" => 50]
                    ],
                    [
                        "年" => 2020, "球団名" => "ニューヨーク・ヤンキース", "球団ID" => null, "タイプ" => "投球",
                        "データ" => ["試合" => 10, "防御率" => "3.56", "勝利" => 3, "敗北" => 3, "奪三振" => 44, "投球回" => "46.2", "自責点" => 18, "被安打" => 40, "与四球" => 10, "与死球" => 1, "失点" => 20]
                    ],
                    [
                        "年" => 2019, "球団名" => "ニューヨーク・ヤンキース", "球団ID" => null, "タイプ" => "投球",
                        "データ" => ["試合" => 32, "防御率" => "4.40", "勝利" => 11, "敗北" => 9, "奪三振" => 149, "投球回" => "182.0", "自責点" => 89, "被安打" => 170, "与四球" => 45, "与死球" => 5, "失点" => 95]
                    ]
                ],
                "通算成績" => [
                    "タイプ" => "投球",
                    "データ" => ["防御率" => "2.95", "勝利" => 180, "敗北" => 90, "奪三振" => 2500, "投球回" => "2400.0"]
                ]
            ];
            $playersToInsert[] = [
                'id' => 2,
                'team_id' => $eaglesId,
                'name' => '田中 将大',
                'jersey_number' => 18,
                'date_of_birth' => '1988-11-01',
                'height' => 188,
                'weight' => 97,
                'status' => '現役',
                'specialty' => 'スプリット',
                'hometown' => '兵庫県伊丹市',
                'description' => '日本球界を代表するエースピッチャー。楽天時代には伝説の24連勝を記録し、チームを日本一に導いた。MLBニューヨーク・ヤンキースでも活躍し、再び楽天に戻ってきた。',
                'career_stats' => json_encode($tanakaCareerStats),
                'created_at' => $now,
                'updated_at' => $now,
            ];
            $playerPositionToInsert[] = ['player_id' => 2, 'position_id' => $positions->firstWhere('name', 'ピッチャー')?->id, 'created_at' => $now, 'updated_at' => $now];
        }

        // --- 残りのダミー選手データをFakerで作成 ---
        $numberOfFakerPlayers = 140; // 140人に設定
        $positionNames = ['ピッチャー', 'キャッチャー', 'ファースト', 'セカンド', 'ショート', 'サード', 'レフト', 'センター', 'ライト', '指名打者'];

        $nextPlayerId = 3;
        // 背番号重複チェックの効率化 (HashMap/連想配列を使用)
        $usedJerseyNumbersMap = [];
        if (isset($playersToInsert[0]['jersey_number'])) {
            $usedJerseyNumbersMap[$playersToInsert[0]['jersey_number']] = true;
        }
        if (isset($playersToInsert[1]['jersey_number'])) {
            $usedJerseyNumbersMap[$playersToInsert[1]['jersey_number']] = true;
        }

        for ($i = 0; $i < $numberOfFakerPlayers; $i++) {
            // 背番号重複チェック
            do {
                $jerseyNumber = $faker->numberBetween(1, 150);
            } while (isset($usedJerseyNumbersMap[$jerseyNumber]));
            $usedJerseyNumbersMap[$jerseyNumber] = true;

            $hometown = $faker->randomElement($prefectures) . $faker->city;

            $descriptionTemplates = [
                '期待の若手%position%。持ち前の%specialty%でチームを牽引する。',
                'ベテラン%position%としてチームを支える精神的支柱。%specialty%で幾多のピンチを救ってきた。',
                'パワフルな打撃が魅力の%position%。%specialty%でファンを魅了する。',
                '精密なコントロールが武器の%position%。%specialty%で打者を翻弄する。',
                '俊足巧打の%position%。%specialty%で塁上を駆け巡る。',
                '将来を嘱望される才能豊かな%position%。%specialty%でチームに貢献する。',
                '守備のスペシャリスト%position%。%specialty%でどんな打球も捌ききる。',
                '長打力が売りの%position%。%specialty%でスタンドを沸かせる。',
            ];
            $selectedPositionName = $faker->randomElement($positionNames);
            $specialty = $faker->randomElement(['フルスイング', '堅実な守備', '切れ味鋭い変化球', '速球', '勝負強いバッティング', '走塁技術', '強肩', '選球眼', '配球術', '守備範囲の広さ']);
            $description = str_replace(
                ['%position%', '%specialty%'],
                [$selectedPositionName, $specialty],
                $faker->randomElement($descriptionTemplates)
            );

            // キャリアスタッツデータ生成のロジックを再導入（詳細化）
            // ポジションに基づいて投手か打者かを決定
            $isPitcher = (strpos($selectedPositionName, 'ピッチャー') !== false);
            if (!$isPitcher && strpos($selectedPositionName, '指名打者') !== false && $faker->boolean(50)) {
                // 指名打者の場合、稀に投手である可能性も考慮しないが、打者メイン
                $isPitcher = false;
            } else if (!$isPitcher && $faker->boolean(10)) {
                // その他のポジションでもごく稀に投手もこなす選手（二刀流的な）
                 $isPitcher = true;
            }


            $careerStatsData = [
                "年度別成績" => [],
                "通算成績" => ["タイプ" => ($isPitcher ? "投球" : "打撃"), "データ" => []]
            ];

            $yearsOfCareer = $faker->numberBetween(1, 7); // キャリア年数を最大7年に設定
            $currentYear = (int)date('Y');

            $initialTeam = $teams->random();
            $currentTeam = $initialTeam;

            for ($k = 0; $k < $yearsOfCareer; $k++) {
                $year = $currentYear - $k;

                if ($k > 0 && $faker->boolean(15)) { // 15%の確率で移籍
                    $otherTeams = $teams->reject(fn($t) => $t->id == $currentTeam->id);
                    if ($otherTeams->isNotEmpty()) {
                        $currentTeam = $otherTeams->random();
                    }
                }

                if ($isPitcher) {
                    $games = $faker->numberBetween(5, 60); // 試合数
                    $inningsPitched = round($faker->randomFloat(1, $games * 2, $games * 6), 1); // 投球回
                    $earnedRuns = round($inningsPitched * $faker->randomFloat(2, 0.2, 0.5)); // 自責点
                    $walks = $faker->numberBetween(ceil($inningsPitched / 5), ceil($inningsPitched / 2)); // 与四球
                    $strikeouts = $faker->numberBetween(ceil($inningsPitched * 0.8), ceil($inningsPitched * 1.5)); // 奪三振
                    $wins = $faker->numberBetween(0, floor($games / 3)); // 勝利
                    $losses = $faker->numberBetween(0, floor($games / 3)); // 敗北

                    // 防御率の計算（0で割るのを防ぐ）
                    $era = ($inningsPitched > 0) ? round(($earnedRuns * 9) / $inningsPitched, 2) : 99.99;
                    if ($era < 1.00) $era = round($faker->randomFloat(2, 1.00, 2.50), 2); // あまりにも低くならないように調整
                    if ($era > 7.00) $era = round($faker->randomFloat(2, 5.00, 7.00), 2); // あまりにも高くならないように調整


                    $careerStatsData["年度別成績"][] = [
                        "年" => $year,
                        "球団名" => $currentTeam->team_name,
                        "球団ID" => $currentTeam->id,
                        "タイプ" => "投球",
                        "データ" => [
                            "試合" => $games,
                            "防御率" => sprintf("%.2f", $era),
                            "勝利" => $wins,
                            "敗北" => $losses,
                            "奪三振" => $strikeouts,
                            "投球回" => sprintf("%.1f", $inningsPitched),
                            "自責点" => $earnedRuns,
                            "被安打" => $faker->numberBetween(round($inningsPitched * 0.8), round($inningsPitched * 1.2)),
                            "与四球" => $walks,
                            "与死球" => $faker->numberBetween(0, ceil($games / 10)),
                            "失点" => $faker->numberBetween($earnedRuns, $earnedRuns + 10),
                        ]
                    ];
                } else { // 打者の場合
                    $games = $faker->numberBetween(50, 143); // 試合数
                    $atBats = $faker->numberBetween(max(1, round($games * 2)), round($games * 4)); // 打数
                    $plateAppearances = $atBats + $faker->numberBetween(round($atBats * 0.05), round($atBats * 0.20)); // 打席
                    $hits = $faker->numberBetween(round($atBats * 0.200), round($atBats * 0.350)); // 安打
                    $doubles = $faker->numberBetween(round($hits * 0.1), round($hits * 0.3)); // 二塁打
                    $triples = $faker->numberBetween(0, round($hits * 0.05)); // 三塁打
                    $homeRuns = $faker->numberBetween(0, 50); // 本塁打
                    $rbi = $faker->numberBetween(0, 150); // 打点
                    $stolenBases = $faker->numberBetween(0, 40); // 盗塁
                    $strikeouts = $faker->numberBetween(round($plateAppearances * 0.1), round($plateAppearances * 0.3)); // 三振
                    $walks = $faker->numberBetween(round($plateAppearances * 0.05), round($plateAppearances * 0.15)); // 四球
                    $hitByPitch = $faker->numberBetween(0, round($plateAppearances * 0.02)); // 死球
                    $sacBunts = $faker->numberBetween(0, round($plateAppearances * 0.05)); // 犠打
                    $sacFlies = $faker->numberBetween(0, round($plateAppearances * 0.02)); // 犠飛
                    $caughtStealing = $faker->numberBetween(0, round($stolenBases * 0.3)); // 盗塁死
                    $doublePlays = $faker->numberBetween(0, round($plateAppearances * 0.05)); // 併殺打
                    $errors = $faker->numberBetween(0, 15); // 失策

                    // 打率、出塁率、長打率、OPSの計算
                    $battingAverage = ($atBats > 0) ? round($hits / $atBats, 3) : 0.000;
                    $onBasePercentage = (($hits + $walks + $hitByPitch) > 0) ? round(($hits + $walks + $hitByPitch) / ($atBats + $walks + $hitByPitch + $sacFlies), 3) : 0.000;
                    $singles = $hits - $doubles - $triples - $homeRuns;
                    $totalBases = ($singles * 1) + ($doubles * 2) + ($triples * 3) + ($homeRuns * 4);
                    $sluggingPercentage = ($atBats > 0) ? round($totalBases / $atBats, 3) : 0.000;
                    $ops = $onBasePercentage + $sluggingPercentage;

                    $careerStatsData["年度別成績"][] = [
                        "年" => $year,
                        "球団名" => $currentTeam->team_name,
                        "球団ID" => $currentTeam->id,
                        "タイプ" => "打撃",
                        "データ" => [
                            "試合" => $games,
                            "打率" => sprintf("%.3f", $battingAverage),
                            "本塁打" => $homeRuns,
                            "打点" => $rbi,
                            "盗塁" => $stolenBases,
                            "打席" => $plateAppearances,
                            "打数" => $atBats,
                            "安打" => $hits,
                            "二塁打" => $doubles,
                            "三塁打" => $triples,
                            "三振" => $strikeouts,
                            "四球" => $walks,
                            "死球" => $hitByPitch,
                            "犠打" => $sacBunts,
                            "犠飛" => $sacFlies,
                            "盗塁死" => $caughtStealing,
                            "併殺打" => $doublePlays,
                            "得点圏打率" => sprintf("%.3f", $faker->randomFloat(3, 0.200, 0.380)),
                            "出塁率" => sprintf("%.3f", $onBasePercentage),
                            "長打率" => sprintf("%.3f", $sluggingPercentage),
                            "OPS" => sprintf("%.3f", $ops),
                            "失策" => $errors
                        ]
                    ];
                }
            }

            // 通算成績のデータ生成を簡素化しつつ、計算可能な形に
            $totalStats = [];
            foreach ($careerStatsData["年度別成績"] as $annualStat) {
                foreach ($annualStat["データ"] as $key => $value) {
                    // 打率、防御率などの計算値は後で計算するので加算しない
                    if (in_array($key, ['打率', '防御率', '出塁率', '長打率', 'OPS', '得点圏打率'])) {
                        continue;
                    }
                    if (!isset($totalStats[$key])) {
                        $totalStats[$key] = 0;
                    }
                    $totalStats[$key] += (float)$value; // 数値として加算
                }
            }

            if ($isPitcher) {
                $totalInningsPitched = $totalStats['投球回'] ?? 0;
                $totalEarnedRuns = $totalStats['自責点'] ?? 0;
                $totalEra = ($totalInningsPitched > 0) ? round(($totalEarnedRuns * 9) / $totalInningsPitched, 2) : 99.99;

                $careerStatsData["通算成績"]["データ"] = [
                    "防御率" => sprintf("%.2f", $totalEra),
                    "勝利" => $totalStats['勝利'] ?? 0,
                    "奪三振" => $totalStats['奪三振'] ?? 0,
                    "敗北" => $totalStats['敗北'] ?? 0,
                    "投球回" => sprintf("%.1f", $totalInningsPitched),
                    "試合" => $totalStats['試合'] ?? 0,
                ];
            } else { // 打者の場合
                $totalAtBats = $totalStats['打数'] ?? 0;
                $totalHits = $totalStats['安打'] ?? 0;
                $totalWalks = $totalStats['四球'] ?? 0;
                $totalHitByPitch = $totalStats['死球'] ?? 0;
                $totalSacFlies = $totalStats['犠飛'] ?? 0;

                $totalBattingAverage = ($totalAtBats > 0) ? round($totalHits / $totalAtBats, 3) : 0.000;
                $totalOnBasePercentage = (($totalHits + $totalWalks + $totalHitByPitch) > 0) ? round(($totalHits + $totalWalks + $totalHitByPitch) / ($totalAtBats + $totalWalks + $totalHitByPitch + $totalSacFlies), 3) : 0.000;

                $totalSingles = ($totalHits - ($totalStats['二塁打'] ?? 0) - ($totalStats['三塁打'] ?? 0) - ($totalStats['本塁打'] ?? 0));
                $totalTotalBases = ($totalSingles * 1) + (($totalStats['二塁打'] ?? 0) * 2) + (($totalStats['三塁打'] ?? 0) * 3) + (($totalStats['本塁打'] ?? 0) * 4);
                $totalSluggingPercentage = ($totalAtBats > 0) ? round($totalTotalBases / $totalAtBats, 3) : 0.000;
                $totalOps = $totalOnBasePercentage + $totalSluggingPercentage;

                $careerStatsData["通算成績"]["データ"] = [
                    "打率" => sprintf("%.3f", $totalBattingAverage),
                    "本塁打" => $totalStats['本塁打'] ?? 0,
                    "打点" => $totalStats['打点'] ?? 0,
                    "盗塁" => $totalStats['盗塁'] ?? 0,
                    "試合" => $totalStats['試合'] ?? 0,
                    "打席" => $totalStats['打席'] ?? 0,
                    "打数" => $totalStats['打数'] ?? 0,
                    "安打" => $totalStats['安打'] ?? 0,
                    "二塁打" => $totalStats['二塁打'] ?? 0,
                    "三塁打" => $totalStats['三塁打'] ?? 0,
                    "三振" => $totalStats['三振'] ?? 0,
                    "四球" => $totalStats['四球'] ?? 0,
                    "死球" => $totalStats['死球'] ?? 0,
                    "犠打" => $totalStats['犠打'] ?? 0,
                    "犠飛" => $totalStats['犠飛'] ?? 0,
                    "盗塁死" => $totalStats['盗塁死'] ?? 0,
                    "併殺打" => $totalStats['併殺打'] ?? 0,
                    "出塁率" => sprintf("%.3f", $totalOnBasePercentage),
                    "長打率" => sprintf("%.3f", $totalSluggingPercentage),
                    "OPS" => sprintf("%.3f", $totalOps),
                    "失策" => $totalStats['失策'] ?? 0,
                ];
            }

            $latestStat = collect($careerStatsData["年度別成績"])->sortByDesc('年')->first();
            $currentTeamForPlayer = $latestStat['球団ID'] ?? $teams->random()->id;

            // Playerデータを配列に追加
            $playersToInsert[] = [
                'id' => $nextPlayerId,
                'team_id' => $currentTeamForPlayer,
                'name' => $faker->name('male'),
                'jersey_number' => $jerseyNumber,
                'date_of_birth' => $faker->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d'),
                'height' => $faker->numberBetween(170, 190),
                'weight' => $faker->numberBetween(70, 95),
                'status' => $faker->randomElement(['現役', '二軍', '育成枠']),
                'specialty' => $specialty,
                'hometown' => $hometown,
                'description' => $description,
                'career_stats' => json_encode($careerStatsData), // JSON形式に変換
                'created_at' => $now,
                'updated_at' => $now,
            ];

            // ポジションデータを配列に追加
            $selectedPositionIds = $positions->random(mt_rand(1, 3))->pluck('id')->toArray();
            foreach ($selectedPositionIds as $positionId) {
                $playerPositionToInsert[] = [
                    'player_id' => $nextPlayerId,
                    'position_id' => $positionId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            $nextPlayerId++;
        }

        // --- 全てのデータを一括挿入 ---
        DB::transaction(function () use ($playersToInsert, $playerPositionToInsert, $numberOfFakerPlayers) {
            Player::insert($playersToInsert);
            DB::table('player_position')->insert($playerPositionToInsert);

            $this->command->info($numberOfFakerPlayers . '人分の男性選手データを作成しました。');
        });
    }
}