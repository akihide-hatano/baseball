<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('チーム一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- リーグ絞り込みのフォーム --}}
                    <div class="mb-4">
                        <form action="{{ route('teams.index') }}" method="GET">
                            <label for="league-select" class="block text-sm font-medium text-gray-700">リーグで絞り込む:</label>
                            <select id="league-select" name="league" onchange="this.form.submit()" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">全てのリーグ</option>
                                <option value="セントラル・リーグ" {{ $selectedLeague == 'セントラル・リーグ' ? 'selected' : '' }}>セントラル・リーグ</option>
                                <option value="パシフィック・リーグ" {{ $selectedLeague == 'パシフィック・リーグ' ? 'selected' : '' }}>パシフィック・リーグ</option>
                            </select>
                        </form>
                    </div>

                    {{-- 現在の絞り込み状態の表示 (オプション) --}}
                    @if ($selectedLeague)
                        <p class="mb-4">現在、**{{ $selectedLeague }}** のチームを表示しています。</p>
                    @endif

                    {{-- チーム一覧のテーブル --}}
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>チーム名</th>
                                <th>リーグ</th>
                                <th>本拠地</th>
                                <th>優勝回数</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)
                            <tr>
                                <td>{{ $team->id }}</td>
                                <td>{{ $team->team_name }}</td>
                                <td>{{ $team->league }}</td>
                                <td>{{ $team->home_stadium }}</td>
                                <td>{{ $team->total_championships }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>