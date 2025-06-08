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

        // ★★★ チームデータを格納する変数を $teams に統一し、初期化も行う ★★★
        $teams = new Collection(); // nullが渡されないように初期化

        if ($selectedLeague) {
            // $selectedLeague がある場合、フィルタリングした結果を $teams に代入
            $teams = Team::where('league',$selectedLeague)->get();
        } else {
            // $selectedLeague がない場合、全てのチームを取得して $teams に代入
            $teams = Team::all();
        }
        return view('teams.index', compact('teams', 'selectedLeague'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
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
