<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('チーム詳細: ' . $team->team_name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $team->team_name }}</h3>

                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2 mb-8">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">ID:</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $team->id }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">リーグ:</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $team->league }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">優勝回数:</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $team->total_championships }}</dd>
                        </div>
                        {{-- スタジアム情報 --}}
                        @if ($team->stadium)
                            <div class="sm:col-span-2 mt-4 border-t pt-4">
                                <h4 class="text-md font-medium text-gray-900 mb-2">本拠地スタジアム</h4>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">スタジアム名:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $team->stadium->name }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">所在地:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $team->stadium->location }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">収容人数:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ number_format($team->stadium->capacity) }}人</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">設立年:</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $team->stadium->build_year }}年</dd>
                            </div>
                        @else
                            <div class="sm:col-span-2 mt-4">
                                <p class="text-sm text-gray-500">本拠地スタジアム情報がありません。</p>
                            </div>
                        @endif
                    </dl>

                    <div class="mt-8 border-t pt-8">
                        <h4 class="text-xl font-medium text-gray-900 mb-4">所属選手一覧</h4>
                        {{-- $team->players がコレクションであり、空でないかを確認 --}}
                        @if ($team->players->isNotEmpty())
                            <ul class="divide-y divide-gray-200">
                                @foreach ($team->players as $player)
                                    <li class="py-3 flex justify-between items-center">
                                        <div>
                                            {{-- ここにaタグを追加 --}}
                                            <p class="text-lg font-semibold text-gray-900">
                                                <a href="{{ route('players.show', $player->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                                    {{ $player->name }}
                                                </a>
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                背番号: {{ $player->jersey_number ?? 'N/A' }} |
                                                生年月日: {{ $player->date_of_birth ? \Carbon\Carbon::parse($player->date_of_birth)->format('Y年m月d日') : 'N/A' }} | {{-- birth_date を date_of_birth に修正 --}}
                                                身長: {{ $player->height ?? 'N/A' }}cm |
                                                体重: {{ $player->weight ?? 'N/A' }}kg |
                                                ステータス: {{ $player->status ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600">このチームにはまだ選手が登録されていません。</p>
                        @endif
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('teams.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            チーム一覧へ戻る
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>