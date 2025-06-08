<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

Route::get('/', function () {
    return view('welcome');
});

// パターンA: Route::resource を使用している場合（最も推奨）
// Route::resource('teams', TeamController::class);

// パターンB: 個別に定義している場合
Route::get('/teams',[TeamController::class,'index'])->name('teams.index'); // この行が正しく存在する
Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show'); // これも存在することを確認


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
