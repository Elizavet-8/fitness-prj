<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

#region controllers usage
use App\Http\Controllers\ProblemZoneController;
use App\Http\Controllers\LifeStyleController;
use App\Http\Controllers\TrainingLocationController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuTypeController;
use App\Http\Controllers\MenuCaloryController;
#endregion

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', function (Request $request) {
   $users= \App\Models\User::all();
    return response()->json($users);
});
Route::get('/users/{id}', function (Request $request, User $user) {
    //$user= \App\Models\User::find($id);
    return response()->json($user);
});

#region api-links
Route::prefix('problem-zone')->group(function () {
    Route::get('/list', [ProblemZoneController::class,'index']);
    Route::get('/show/{id}', [ProblemZoneController::class,'show']);
    Route::post('/create', [ProblemZoneController::class,'store']);
    Route::put('/update/{id}', [ProblemZoneController::class,'update']);
    Route::delete('/delete/{id}', [ProblemZoneController::class,'destroy']);
});
Route::prefix('life-style')->group(function () {
    Route::get('/list', [LifeStyleController::class,'index']);
    Route::get('/show/{id}', [LifeStyleController::class,'show']);
    Route::post('/create', [LifeStyleController::class,'store']);
    Route::put('/update/{id}', [LifeStyleController::class,'update']);
    Route::delete('/delete/{id}', [LifeStyleController::class,'destroy']);
});
Route::prefix('training-location')->group(function () {
    Route::get('/list', [TrainingLocationController::class,'index']);
    Route::get('/show/{id}', [TrainingLocationController::class,'show']);
    Route::post('/create', [TrainingLocationController::class,'store']);
    Route::put('/update/{id}', [TrainingLocationController::class,'update']);
    Route::delete('/delete/{id}', [TrainingLocationController::class,'destroy']);
});
Route::prefix('menu-calory')->group(function () {
    Route::get('/list', [MenuCaloryController::class,'index']);
    Route::get('/show/{id}', [MenuCaloryController::class,'show']);
    Route::post('/create', [MenuCaloryController::class,'store']);
    Route::put('/update/{id}', [MenuCaloryController::class,'update']);
    Route::delete('/delete/{id}', [MenuCaloryController::class,'destroy']);
});
Route::prefix('menu-type')->group(function () {
    Route::get('/list', [MenuTypeController::class,'index']);
    Route::get('/show/{id}', [MenuTypeController::class,'show']);
    Route::post('/create', [MenuTypeController::class,'store']);
    Route::put('/update/{id}', [MenuTypeController::class,'update']);
    Route::delete('/delete/{id}', [MenuTypeController::class,'destroy']);
});
Route::prefix('menu')->group(function () {
    Route::get('/list', [MenuController::class,'index']);
    Route::get('/show/{id}', [MenuController::class,'show']);
    Route::post('/create', [MenuController::class,'store']);
    Route::put('/update/{id}', [MenuController::class,'update']);
    Route::delete('/delete/{id}', [MenuController::class,'destroy']);
});
Route::prefix('training')->group(function () {
    Route::get('/list', [TrainingController::class,'index']);
    Route::get('/show/{id}', [TrainingController::class,'show']);
    Route::post('/create', [TrainingController::class,'store']);
    Route::put('/update/{id}', [TrainingController::class,'update']);
    Route::delete('/delete/{id}', [TrainingController::class,'destroy']);
});
#endregion
#region resources
/*Route::apiResource('problem-zone', ProblemZoneController::class);
Route::apiResource('life-style', LifeStyleController::class);
Route::apiResource('training-location', TrainingLocationController::class);
Route::apiResource('menu-calory', MenuCaloryController::class);
Route::apiResource('menu-type', MenuTypeController::class);
Route::apiResource('personal-account', PersonalAccountController::class);
Route::apiResource('menu', MenuController::class);
Route::apiResource('user-menu', UserMenuController::class);
Route::apiResource('food-calendar', FoodCalendarController::class);
Route::apiResource('training', TrainingController::class);
Route::apiResource('training-user', TrainingUserController::class);
Route::apiResource('activity-calendar', ActivityCalendarController::class);
Route::apiResource('notification', App\Http\Controllers\NotificationController::class);*/
#endregion