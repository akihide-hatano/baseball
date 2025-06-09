<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedLeague = $request->query('league');
        if ($selectedLeague) {
            // $selectedLeague がある場合、フィルタリングした結果を $teams に代入
            $teams = Team::where('league',$selectedLeague)->with('stadium')->get();
        } else {
            // $selectedLeague がない場合、全てのチームを取得して $teams に代入
            $teams = Team::with('stadium')->get();
        }
        return view('teams.index', compact('teams', 'selectedLeague'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Team $team)
    {
        $team->load('stadium');
        // dd($team);
        // return view('teams.show',compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        // ★★★ この行を追加してください ★★★
        $team->load('stadium');

        // ★★★ dd の位置を load の後に移動し、再度確認してください ★★★
        // dd($team);
        // dd($team->stadium->name); // 特定のスタジアム名が出力されるか確認
        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
