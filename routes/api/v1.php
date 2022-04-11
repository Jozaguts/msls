<?php


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoryController,
    GameController,
    GenderController,
    PenaltyController,
    PenaltyGoalKeeperController,
    PlayersController,
    RefereeController,
    TeamsController,
    GameGeneralDetailsController,
    GameTimeDetailsController,
};

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
require __DIR__ . '/../json-api-auth.php';


Route::group(['prefix' => '/auth',['middleware' => 'throttle:20,5']], function(){
    Route::get('/login/{service}',[\App\Http\Controllers\SocialLoginController::class, 'redirect']);
    Route::get('/login/{service}/callback',[\App\Http\Controllers\SocialLoginController::class, 'callback']);
});
Route::middleware(['auth:api'])->group(function(){
    Route::post('/hard-delete', function() {
        DB::beginTransaction();
        try{
            $result = DB::table(request()->input('table'))
                ->delete(request()->input('id'));
            DB::commit();

             return response()->json(['data'=> ['message' => $result ? 'register was hard deleted successfully' : 'register not fount']]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json( $e->getMessage(),400);
        }

    });
    Route::apiResources(['genders'=> GenderController::class]);
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
    Route::apiResources([
        'game-details' => GameGeneralDetailsController::class
    ]);
    Route::apiResources([
        'game-time-details' => GameTimeDetailsController::class
    ]);
    Route::apiResources([
        'game-action-details' => GameTimeDetailsController::class
    ]);
});

