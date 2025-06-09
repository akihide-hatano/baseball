<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;
use App\Models\Team;
use App\Models\Position;
use Faker\Factory as Faker;

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
        $giantsId = $teams->firstWhere('team_name', '読売ジャイアンツ') ? $teams->firstWhere('team_name', '読売ジャイアンツ')->id : null;
        $eaglesId = $teams->firstWhere('team_name', '東北楽天ゴールデンイーグルス') ? $teams->firstWhere('team_name', '東北楽天ゴールデンイーグルス')->id : null;
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


        // --- 具体的な選手のデータ例 (2人) ---
        // ここは手動で日本語に調整
        if ($giantsId) {
            $sakamoto = Player::create([
                'team_id' => $giantsId,
                'name' => '坂本 勇人',
                'jersey_number' => 6,
                'date_of_birth' => '1988-12-14',
                'height' => 186,
                'weight' => 86,
                'status' => '現役',
                'specialty' => '広角打法',
                'hometown' => '兵庫県伊丹市', // 何県何市形式
                'description' => '読売ジャイアンツのキャプテンであり、球界を代表する遊撃手。安定した守備と勝負強い打撃が魅力で、数々のタイトルを獲得している。WBCにも出場し、チームの勝利に貢献。',
                'career_stats' => [
                    "年度別成績" => [
                        [
                            "年" => 2024, "球団名" => "読売ジャイアンツ", "球団ID" => $giantsId, "タイプ" => "打撃",
                            "データ" => ["試合" => 135, "打率" => ".305", "本塁打" => 28, "打点" => 85, "盗塁" => 5]
                        ],
                        [
                            "年" => 2023, "球団名" => "読売ジャイアンツ", "球団ID" => $giantsId, "タイプ" => "打撃",
                            "データ" => ["試合" => 120, "打率" => ".298", "本塁打" => 22, "打点" => 78, "盗塁" => 3]
                        ],
                        [
                            "年" => 2022, "球団名" => "読売ジャイアンツ", "球団ID" => $giantsId, "タイプ" => "打撃",
                            "データ" => ["試合" => 100, "打率" => ".270", "本塁打" => 15, "打点" => 60, "盗塁" => 2]
                        ],
                        [
                            "年" => 2021, "球団名" => "読売ジャイアンツ", "球団ID" => $giantsId, "タイプ" => "打撃",
                            "データ" => ["試合" => 130, "打率" => ".315", "本塁打" => 35, "打点" => 105, "盗塁" => 7]
                        ],
                        [
                            "年" => 2020, "球団名" => "読売ジャイアンツ", "球団ID" => $giantsId, "タイプ" => "打撃",
                            "データ" => ["試合" => 110, "打率" => ".290", "本塁打" => 20, "打点" => 65, "盗塁" => 4]
                        ]
                    ],
                    "通算成績" => [
                        "タイプ" => "打撃",
                        "データ" => ["打率" => ".300", "本塁打" => 450, "打点" => 1500, "盗塁" => 150]
                    ]
                ]
            ]);
            $sakamoto->positions()->attach($positions->firstWhere('name', 'ショート')?->id);
            $sakamoto->positions()->attach($positions->firstWhere('name', 'セカンド')?->id);
        }

        if ($eaglesId) {
            $tanaka = Player::create([
                'team_id' => $eaglesId,
                'name' => '田中 将大',
                'jersey_number' => 18,
                'date_of_birth' => '1988-11-01',
                'height' => 188,
                'weight' => 97,
                'status' => '現役',
                'specialty' => 'スプリット',
                'hometown' => '兵庫県伊丹市', // 何県何市形式
                'description' => '日本球界を代表するエースピッチャー。楽天時代には伝説の24連勝を記録し、チームを日本一に導いた。MLBニューヨーク・ヤンキースでも活躍し、再び楽天に戻ってきた。',
                'career_stats' => [
                    "年度別成績" => [
                        [
                            "年" => 2024, "球団名" => "東北楽天ゴールデンイーグルス", "球団ID" => $eaglesId, "タイプ" => "投球",
                            "データ" => ["試合" => 25, "防御率" => "3.10", "勝利" => 10, "敗北" => 8, "奪三振" => 150, "投球回" => "160.0"]
                        ],
                        [
                            "年" => 2023, "球団名" => "東北楽天ゴールデンイーグルス", "球団ID" => $eaglesId, "タイプ" => "投球",
                            "データ" => ["試合" => 20, "防御率" => "3.50", "勝利" => 8, "敗北" => 10, "奪三振" => 120, "投球回" => "140.0"]
                        ],
                        [
                            "年" => 2022, "球団名" => "東北楽天ゴールデンイーグルス", "球団ID" => $eaglesId, "タイプ" => "投球",
                            "データ" => ["試合" => 25, "防御率" => "2.80", "勝利" => 13, "敗北" => 7, "奪三振" => 160, "投球回" => "175.0"]
                        ],
                        [
                            "年" => 2021, "球団名" => "東北楽天ゴールデンイーグルス", "球団ID" => $eaglesId, "タイプ" => "投球",
                            "データ" => ["試合" => 23, "防御率" => "2.90", "勝利" => 11, "敗北" => 6, "奪三振" => 140, "投球回" => "150.0"]
                        ],
                        [
                            "年" => 2020, "球団名" => "ニューヨーク・ヤンキース", "球団ID" => null, "タイプ" => "投球",
                            "データ" => ["試合" => 10, "防御率" => "3.56", "勝利" => 3, "敗北" => 3, "奪三振" => 44, "投球回" => "46.2"]
                        ],
                        [
                            "年" => 2019, "球団名" => "ニューヨーク・ヤンキース", "球団ID" => null, "タイプ" => "投球",
                            "データ" => ["試合" => 32, "防御率" => "4.40", "勝利" => 11, "敗北" => 9, "奪三振" => 149, "投球回" => "182.0"]
                        ]
                    ],
                    "通算成績" => [
                        "タイプ" => "投球",
                        "データ" => ["防御率" => "2.95", "勝利" => 180, "敗北" => 90, "奪三振" => 2500, "投球回" => "2400.0"]
                    ]
                ]
            ]);
            $tanaka->positions()->attach($positions->firstWhere('name', 'ピッチャー')?->id);
        }

        // --- 残りの98人分のダミー選手データをFakerで作成 ---
        $numberOfFakerPlayers = 98;
        $positionNames = ['ピッチャー', 'キャッチャー', 'ファースト', 'セカンド', 'ショート', 'サード', 'レフト', 'センター', 'ライト', '指名打者'];

        $usedJerseyNumbers = [6, 18]; // 坂本選手と田中選手の背番号を初期値として設定

        for ($i = 0; $i < $numberOfFakerPlayers; $i++) {
            $isPitcher = $faker->boolean(40); // 40%の確率で投手

            // 重複しない背番号を生成
            do {
                $jerseyNumber = $faker->numberBetween(1, 150);
            } while (in_array($jerseyNumber, $usedJerseyNumbers));
            $usedJerseyNumbers[] = $jerseyNumber;

            // 出身地を「都道府県市町村」形式で生成
            $hometown = $faker->randomElement($prefectures) . $faker->city;

            // 野球選手らしい説明文を生成
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
            $selectedPositionName = $faker->randomElement($positionNames); // 説明文用のポジション名
            $specialty = $faker->randomElement(['フルスイング', '堅実な守備', '切れ味鋭い変化球', '速球', '勝負強いバッティング', '走塁技術', '強肩', '選球眼', '配球術', '守備範囲の広さ']);
            $description = str_replace(
                ['%position%', '%specialty%'],
                [$selectedPositionName, $specialty],
                $faker->randomElement($descriptionTemplates)
            );


            $careerStatsData = [
                "年度別成績" => [], // キーを日本語に
                "通算成績" => ["タイプ" => ($isPitcher ? "投球" : "打撃"), "データ" => []] // キーを日本語に
            ];

            $yearsOfCareer = $faker->numberBetween(3, 7);
            $currentYear = (int)date('Y');

            $initialTeam = $teams->random();
            $currentTeam = $initialTeam;

            for ($k = 0; $k < $yearsOfCareer; $k++) {
                $year = $currentYear - $k;

                if ($k > 0 && $faker->boolean(20)) {
                    $otherTeams = $teams->reject(fn($t) => $t->id == $currentTeam->id);
                    if ($otherTeams->isNotEmpty()) {
                        $currentTeam = $otherTeams->random();
                    }
                }

                if ($isPitcher) {
                    $careerStatsData["年度別成績"][] = [
                        "年" => $year,
                        "球団名" => $currentTeam->team_name,
                        "球団ID" => $currentTeam->id,
                        "タイプ" => "投球",
                        "データ" => [
                            "試合" => $faker->numberBetween(10, 30),
                            "防御率" => round($faker->randomFloat(2, 2.00, 5.00), 2),
                            "勝利" => $faker->numberBetween(3, 15),
                            "敗北" => $faker->numberBetween(3, 10),
                            "奪三振" => $faker->numberBetween(50, 200),
                            "投球回" => round($faker->randomFloat(1, 80, 180), 1)
                        ]
                    ];
                } else {
                    $careerStatsData["年度別成績"][] = [
                        "年" => $year,
                        "球団名" => $currentTeam->team_name,
                        "球団ID" => $currentTeam->id,
                        "タイプ" => "打撃",
                        "データ" => [
                            "試合" => $faker->numberBetween(80, 143),
                            "打率" => round($faker->randomFloat(3, 0.230, 0.330), 3),
                            "本塁打" => $faker->numberBetween(5, 40),
                            "打点" => $faker->numberBetween(20, 120),
                            "盗塁" => $faker->numberBetween(0, 30)
                        ]
                    ];
                }
            }

            // 通算成績のダミーを生成 (キャリアの成績を基に、よりリアルな値を設定)
            if ($isPitcher) {
                $totalGames = array_sum(array_column($careerStatsData["年度別成績"], 'データ.試合'));
                $totalWins = array_sum(array_column($careerStatsData["年度別成績"], 'データ.勝利'));
                $totalLosses = array_sum(array_column($careerStatsData["年度別成績"], 'データ.敗北'));
                $totalStrikeouts = array_sum(array_column($careerStatsData["年度別成績"], 'データ.奪三振'));
                $totalInningsPitched = array_sum(array_column($careerStatsData["年度別成績"], 'データ.投球回'));
                $overallEra = ($totalInningsPitched > 0) ? round($faker->randomFloat(2, 2.50, 4.00), 2) : 0.00;

                $careerStatsData["通算成績"]["データ"] = [
                    "防御率" => $overallEra,
                    "勝利" => $totalWins,
                    "敗北" => $totalLosses,
                    "奪三振" => $totalStrikeouts,
                    "投球回" => $totalInningsPitched
                ];
            } else {
                $totalGames = array_sum(array_column($careerStatsData["年度別成績"], 'データ.試合'));
                $totalHR = array_sum(array_column($careerStatsData["年度別成績"], 'データ.本塁打'));
                $totalRBIs = array_sum(array_column($careerStatsData["年度別成績"], 'データ.打点'));
                $totalSB = array_sum(array_column($careerStatsData["年度別成績"], 'データ.盗塁'));
                $totalHits = 0;
                $totalAtBats = 0;
                foreach ($careerStatsData["年度別成績"] as $yearStat) {
                    $atBats = $yearStat['データ']['試合'] * $faker->numberBetween(3, 5);
                    $hits = round($atBats * $yearStat['データ']['打率']);
                    $totalHits += $hits;
                    $totalAtBats += $atBats;
                }
                $overallAvg = ($totalAtBats > 0) ? round($totalHits / $totalAtBats, 3) : 0.000;

                $careerStatsData["通算成績"]["データ"] = [
                    "打率" => $overallAvg,
                    "本塁打" => $totalHR,
                    "打点" => $totalRBIs,
                    "盗塁" => $totalSB
                ];
            }

            $latestStat = collect($careerStatsData["年度別成績"])->sortByDesc('年')->first(); // キー名を修正
            $currentTeamForPlayer = $latestStat['球団ID'] ?? $teams->random()->id; // キー名を修正

            $player = Player::create([
                'team_id' => $currentTeamForPlayer,
                'name' => $faker->name,
                'jersey_number' => $jerseyNumber,
                'date_of_birth' => $faker->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d'),
                'height' => $faker->numberBetween(170, 190),
                'weight' => $faker->numberBetween(70, 95),
                'status' => $faker->randomElement(['現役', '二軍', '故障者リスト']),
                'specialty' => $specialty, // descriptionで使ったspecialtyをそのまま入れる
                'hometown' => $hometown, // 生成した出身地
                'description' => $description, // 生成した説明文
                'career_stats' => $careerStatsData
            ]);

            // ポジションをアタッチ
            $player->positions()->attach(
                $positions->random(mt_rand(1, 3))->pluck('id')->toArray()
            );
        }

        $this->command->info('100人分の選手データを作成しました。');
    }
}