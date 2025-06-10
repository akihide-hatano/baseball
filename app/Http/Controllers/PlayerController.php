<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $player= Player::with('team','positions')->orderBy('name')->get();
        return view('players.index',compact('players'));
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
    public function show(Player $player)
    {
        $player->load('team');
        // $team変数をビューに渡す
        $team = $player->team;

        return view('players.show',compact('player','team'));
    }

    public function showByTeam(Team $team,Player $player){

        if($player->team_id !== $team->id){
            abort(404,'選手が指定されたチームに所属していません');
        }

        $player->load('team','positions');
        return view('teams.players.show', compact('team', 'player'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }
}
