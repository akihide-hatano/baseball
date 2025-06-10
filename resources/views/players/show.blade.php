<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('選手詳細: ' . ($player->name ?? '')) }}
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
                                    @if ($player->team)
                                        <a href="{{ route('teams.show', $player->team->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                            {{ $player->team->team_name }}
                                        </a>
                                    @else
                                        不明
                                    @endif
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
                                <dd class="mt-1 text-sm text-gray-900">{{ $player->description }}</dd>
                            </div>
                        </dl>

                        <div class="mt-8 border-t pt-8">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">キャリア成績</h4>
                            @if (isset($player->career_stats['年度別成績']))
                                <h5 class="text-md font-medium text-gray-700 mb-2">年度別成績</h5>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">年</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">球団名</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">試合</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">打率/防御率</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">本塁打/勝利</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">打点/敗北</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">盗塁/奪三振</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">投球回</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($player->career_stats['年度別成績'] as $stats)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['年'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['球団名'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stats['データ']['試合'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        @if ($stats['タイプ'] === '打撃')
                                                            {{ $stats['データ']['打率'] }}
                                                        @else
                                                            {{ $stats['データ']['防御率'] }}
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        @if ($stats['タイプ'] === '打撃')
                                                            {{ $stats['データ']['本塁打'] }}
                                                        @else
                                                            {{ $stats['データ']['勝利'] }}
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        @if ($stats['タイプ'] === '打撃')
                                                            {{ $stats['データ']['打点'] }}
                                                        @else
                                                            {{ $stats['データ']['敗北'] }}
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        @if ($stats['タイプ'] === '打撃')
                                                            {{ $stats['データ']['盗塁'] }}
                                                        @else
                                                            {{ $stats['データ']['奪三振'] }}
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        @if ($stats['タイプ'] === '投球')
                                                            {{ $stats['データ']['投球回'] }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-gray-600">年度別成績データがありません。</p>
                            @endif

                            @if (isset($player->career_stats['通算成績']))
                                <h5 class="text-md font-medium text-gray-700 mt-4 mb-2">通算成績</h5>
                                <ul class="list-disc list-inside text-gray-900">
                                    @foreach ($player->career_stats['通算成績']['データ'] as $key => $value)
                                        <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @else
                        <p class="text-gray-600">選手データが見つかりませんでした。</p>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('players.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            全選手一覧へ戻る
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>