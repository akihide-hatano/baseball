<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'jersey_number',
        'date_of_birth',
        'height',
        'weight',
        'status',
        'specialty',
        'hometown',
        'career_stats',
        'description',
    ];

    protected $casts =[
        'date_of_birth'=>'date',
        'career_stats' => 'array',
    ];

    /**
     * Get the team that owns the player.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * The positions that belong to the player.
     */
    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'player_position');
    }

    /**
     * Determine if the player is a pitcher.
     * @return bool
     */
    public function getIsPitcherAttribute():bool{
        return $this ->positions->contains(function($position){
            return in_array($position->name, ['投手', 'P', 'Pitcher']);
        });
    }

/**
     * Determine if the player is a batter.
     * @return bool
     */
    public function getIsBatterAttribute(): bool
    {
        // ピッチャーでなければバッターと判断 (または打撃系のポジション名で判断)
        return !$this->is_pitcher;
    }

    /**
     * 通算成績を計算して取得するアクセサ
     *
     * @return array
     */
    public function getTotalStatsAttribute(): array
    {
        // career_statsが配列でない場合や、年度別成績がない場合は空の配列を返す
        if (!is_array($this->career_stats) || !isset($this->career_stats['年度別成績'])) {
            return [];
        }

        $annualStats = $this->career_stats['年度別成績'];
        $totalStats = [];

        if ($this->is_batter) {
            // 打者成績の集計
            $totalGames = 0;
            $totalAtBats = 0; // 打率計算のために必要
            $totalHits = 0;   // 打率計算のために必要
            $totalHomeRuns = 0;
            $totalRBIs = 0; // 打点
            $totalStolenBases = 0; // 盗塁

            foreach ($annualStats as $yearStat) {
                if (isset($yearStat['タイプ']) && $yearStat['タイプ'] === '打撃') {
                    $totalGames += $yearStat['データ']['試合'] ?? 0;
                    $totalAtBats += $yearStat['データ']['打数'] ?? 0; // 打数が必要であれば追加
                    $totalHits += $yearStat['データ']['安打'] ?? 0;   // 安打が必要であれば追加
                    $totalHomeRuns += $yearStat['データ']['本塁打'] ?? 0;
                    $totalRBIs += $yearStat['データ']['打点'] ?? 0;
                    $totalStolenBases += $yearStat['データ']['盗塁'] ?? 0;
                }
            }

            // 打率の計算 (安打/打数)。打数がない場合は0
            $battingAverage = ($totalAtBats > 0) ? round($totalHits / $totalAtBats, 3) : 0;
            $totalStats = [
                'タイプ' => '打撃',
                '試合' => $totalGames,
                '打率' => sprintf('%.3f', $battingAverage), // 小数点以下3桁でフォーマット
                '本塁打' => $totalHomeRuns,
                '打点' => $totalRBIs,
                '盗塁' => $totalStolenBases,
                // 必要に応じて他の打者成績を追加
            ];

        } elseif ($this->is_pitcher) {
            // 投手成績の集計
            $totalGames = 0;
            $totalWins = 0;
            $totalLosses = 0;
            $totalStrikeouts = 0;
            $totalInningsPitched = 0; // 投球回
            $totalEarnedRuns = 0; // 防御率計算のために必要
            $totalOuts = 0; // 投球回計算のために必要 (例: 100回1/3 = 100 + 1/3)

            foreach ($annualStats as $yearStat) {
                if (isset($yearStat['タイプ']) && $yearStat['タイプ'] === '投球') {
                    $totalGames += $yearStat['データ']['試合'] ?? 0;
                    $totalWins += $yearStat['データ']['勝利'] ?? 0;
                    $totalLosses += $yearStat['データ']['敗北'] ?? 0;
                    $totalStrikeouts += $yearStat['データ']['奪三振'] ?? 0;
                    // 投球回を正確に集計するために少し複雑になる
                    // 例: "100回1/3" を数値に変換して加算
                    $innings = $yearStat['データ']['投球回'] ?? '0';
                    if (strpos($innings, '/') !== false) {
                        list($whole, $fraction) = explode('/', $innings);
                        $totalOuts += (int)$whole * 3 + (int)$fraction;
                    } else {
                        $totalOuts += (int)$innings * 3;
                    }

                    $totalEarnedRuns += $yearStat['データ']['自責点'] ?? 0; // 自責点が必要であれば追加
                }
            }
            
            // 投球回を「〇回〇/3」形式に戻す
            $fullInnings = floor($totalOuts / 3);
            $fractionOuts = $totalOuts % 3;
            $formattedInningsPitched = $fullInnings;
            if ($fractionOuts > 0) {
                $formattedInningsPitched .= sprintf('と%d/3', $fractionOuts);
            }

            // 防御率の計算 (自責点 * 9 / 投球回)。投球回が0の場合は0
            $era = ($totalInningsPitched > 0) ? round(($totalEarnedRuns * 9) / $totalInningsPitched, 2) : 0;
            if ($totalOuts > 0) {
                $era = round(($totalEarnedRuns * 9) / ($totalOuts / 3), 2);
            } else {
                $era = 0;
            }


            $totalStats = [
                'タイプ' => '投球',
                '試合' => $totalGames,
                '勝利' => $totalWins,
                '敗北' => $totalLosses,
                '奪三振' => $totalStrikeouts,
                '投球回' => $formattedInningsPitched,
                '防御率' => sprintf('%.2f', $era), // 小数点以下2桁でフォーマット
                // 必要に応じて他の投手成績を追加
            ];
        } else {
            // タイプが不明な場合のフォールバック (career_statsに直接通算成績があればそれを返すなど)
            // または、ここでエラーログを出すなど
            $totalStats = [
                'タイプ' => '不明',
                'メッセージ' => '選手のタイプが判別できませんでした。'
            ];
        }

        return $totalStats;
    }


}