<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Models\Player;

Route::get('/', function () {
    return view('welcome');
});

//チーム一覧
Route::get('/teams',[TeamController::class,'index'])->name('teams.index');
//特定のチーム詳細
Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
//汎用的な単独選手詳細ページ
Route::get('/players/{player}',[PlayerController::class,'show'])->name('players.show');
//特的のチームに紐ずく選手の詳細ページ
Route::get('/teams/{team}/players/{player}', [PlayerController::class, 'showByTeam'])->name('teams.players.show');

Route::get('/player-stats', function () {
    $player = Player::first();
    return view('player-stats', compact('player'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
