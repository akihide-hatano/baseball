<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('選手詳細: ' . ($player->name ?? '') . ' (所属チーム: ' . ($team->team_name ?? '不明') . ')') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($player)
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $player->name }}</h3>

                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2 mb-8">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">背番号:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $player->jersey_number }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">所属チーム:</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{-- ここでは$team変数があるので、それを使ってリンクを生成 --}}
                                    <a href="{{ route('teams.show', $team->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                        {{ $team->team_name ?? '不明' }}
                                    </a>
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">ポジション:</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @forelse ($player->positions as $position)
                                        {{ $position->name }}@unless($loop->last), @endunless
                                    @empty
                                        不明
                                    @endforelse
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">生年月日:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($player->date_of_birth)->format('Y年m月d日') }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">身長:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $player->height }}cm</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">体重:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $player->weight }}kg</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">ステータス:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $player->status }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">得意技:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $player->specialty }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">出身地:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $player->hometown }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">説明:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $player->description ?? 'N/A' }}</dd>
                            </div>
                        </dl>

                        <div class="mt-8 border-t pt-8">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">キャリア成績</h4>

                            {{-- 年度別成績の表示 --}}
                            @if (isset($player->career_stats['年度別成績']) && !empty($player->career_stats['年度別成績']))
                                <h5 class="text-md font-medium text-gray-700 mb-2">年度別成績</h5>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">年</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">球団名</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">試合</th>

                                                {{-- ピッチャーとバッターでヘッダーを分岐 --}}
                                                @if ($player->is_batter)
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">打率</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">本塁打</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">打点</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">盗塁</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th> {{-- 投球回の空白セル --}}
                                                @elseif ($player->is_pitcher)
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">防御率</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">勝利</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">敗北</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">奪三振</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">投球回</th>
                                                @else
                                                    {{-- タイプ不明の場合のヘッダー --}}
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">主な成績1</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">主な成績2</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">主な成績3</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">主な成績4</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">主な成績5</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($player->career_stats['年度別成績'] as $stats)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['年'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['球団名'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['試合'] ?? '-' }}</td>

                                                    {{-- ピッチャーとバッターでデータを分岐 --}}
                                                    @if ($stats['タイプ'] === '打撃') {{-- ここは$stats['タイプ']で判断する方が安全 --}}
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['打率'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['本塁打'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['打点'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['盗塁'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td> {{-- 投手用の投球回は表示しない --}}
                                                    @elseif ($stats['タイプ'] === '投球') {{-- ここは$stats['タイプ']で判断する方が安全 --}}
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['防御率'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['勝利'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['敗北'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['奪三振'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['投球回'] ?? '-' }}</td>
                                                    @else
                                                        {{-- タイプ不明の場合のデータ表示 (必要に応じて調整) --}}
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['打率'] ?? $stats['データ']['防御率'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['本塁打'] ?? $stats['データ']['勝利'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['打点'] ?? $stats['データ']['敗北'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['盗塁'] ?? $stats['データ']['奪三振'] ?? '-' }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['投球回'] ?? '-' }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-gray-600">年度別成績データがありません。</p>
                            @endif

                            {{-- 通算成績の表示 --}}
                            @if (!empty($player->total_stats)) {{-- total_statsアクセサが空でないか確認 --}}
                                <h5 class="text-md font-medium text-gray-700 mt-4 mb-2">通算成績</h5>
                                <ul class="list-disc list-inside text-gray-900">
                                    <li><strong>タイプ:</strong> {{ $player->total_stats['タイプ'] ?? '不明' }}</li>

                                    @if ($player->is_batter)
                                        <li><strong>試合:</strong> {{ $player->total_stats['試合'] ?? '-' }}</li>
                                        <li><strong>打率:</strong> {{ $player->total_stats['打率'] ?? '-' }}</li>
                                        <li><strong>本塁打:</strong> {{ $player->total_stats['本塁打'] ?? '-' }}</li>
                                        <li><strong>打点:</strong> {{ $player->total_stats['打点'] ?? '-' }}</li>
                                        <li><strong>盗塁:</strong> {{ $player->total_stats['盗塁'] ?? '-' }}</li>
                                    @elseif ($player->is_pitcher)
                                        <li><strong>試合:</strong> {{ $player->total_stats['試合'] ?? '-' }}</li>
                                        <li><strong>防御率:</strong> {{ $player->total_stats['防御率'] ?? '-' }}</li>
                                        <li><strong>勝利:</strong> {{ $player->total_stats['勝利'] ?? '-' }}</li>
                                        <li><strong>敗北:</strong> {{ $player->total_stats['敗北'] ?? '-' }}</li>
                                        <li><strong>奪三振:</strong> {{ $player->total_stats['奪三振'] ?? '-' }}</li>
                                        <li><strong>投球回:</strong> {{ $player->total_stats['投球回'] ?? '-' }}</li>
                                    @else
                                        {{-- タイプが不明な場合、計算された全てのデータをループで表示 --}}
                                        @foreach ($player->total_stats as $key => $value)
                                            @if ($key !== 'タイプ') {{-- タイプは既に表示済みなのでスキップ --}}
                                                <li><strong>{{ $key }}:</strong> {{ $value ?? '-' }}</li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            @else
                                <p class="text-gray-600">通算成績データがありません。</p>
                            @endif
                        </div>

                        <div class="mt-6">
                            {{-- 所属チーム詳細へ戻るリンク --}}
                            <a href="{{ route('teams.show', $team->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                                所属チームへ戻る
                            </a>
                            {{-- 全選手一覧へ戻るリンク（オプション） --}}
                            <a href="{{ route('players.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                全選手一覧へ戻る
                            </a>
                        </div>
                    @else
                        <p class="text-gray-600">選手データが見つかりませんでした。</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>