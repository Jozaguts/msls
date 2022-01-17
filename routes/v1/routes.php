<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\PenaltyGoalKeeperController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\RefereeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TeamsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth:api'])->group(function(){
    Route::apiResources([
        'teams' => TeamsController::class
    ]);
    Route::apiResources([
        'players' => PlayersController::class
    ]);
    Route::apiResources([
        'categories' => CategoryController::class
    ]);
    Route::apiResources([
        'referees' => RefereeController::class
    ]);
    Route::apiResources([
        'penalties' => PenaltyController::class
    ]);
    Route::apiResources([
        'teams' => TeamsController::class
    ]);
    Route::apiResources([
        'penalty-goal-keepers' => PenaltyGoalKeeperController::class
    ]);
    Route::apiResources([
        'games' => GameController::class
    ]);

});


