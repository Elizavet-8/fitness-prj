<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
#region controllers usage
use App\Http\Controllers\ProblemZoneController;
use App\Http\Controllers\LifeStyleController;
use App\Http\Controllers\TrainingLocationController;
use App\Http\Controllers\ActivityCalendarController;
use App\Http\Controllers\TrainingUserController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\FoodCalendarController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PersonalAccountController;
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
Route::prefix('personal-account')->group(function () {
    Route::get('/list', [PersonalAccountController::class,'index']);
    Route::get('/show/{id}', [PersonalAccountController::class,'show']);
    Route::post('/create', [PersonalAccountController::class,'store']);
    Route::put('/update/{id}', [PersonalAccountController::class,'update']);
    Route::delete('/delete/{id}', [PersonalAccountController::class,'destroy']);
});
Route::prefix('menu')->group(function () {
    Route::get('/list', [MenuController::class,'index']);
    Route::get('/show/{id}', [MenuController::class,'show']);
    Route::post('/create', [MenuController::class,'store']);
    Route::put('/update/{id}', [MenuController::class,'update']);
    Route::delete('/delete/{id}', [MenuController::class,'destroy']);
});
Route::prefix('user-menu')->group(function () {
    Route::get('/list', [UserMenuController::class,'index']);
    Route::get('/show/{id}', [UserMenuController::class,'show']);
    Route::post('/create', [UserMenuController::class,'store']);
    Route::put('/update/{id}', [UserMenuController::class,'update']);
    Route::delete('/delete/{id}', [UserMenuController::class,'destroy']);
});
Route::prefix('food-calendar')->group(function () {
    Route::get('/list', [FoodCalendarController::class,'index']);
    Route::get('/show/{id}', [FoodCalendarController::class,'show']);
    Route::post('/create', [FoodCalendarController::class,'store']);
    Route::put('/update/{id}', [FoodCalendarController::class,'update']);
    Route::delete('/delete/{id}', [FoodCalendarController::class,'destroy']);
});
Route::prefix('training')->group(function () {
    Route::get('/list', [TrainingController::class,'index']);
    Route::get('/show/{id}', [TrainingController::class,'show']);
    Route::post('/create', [TrainingController::class,'store']);
    Route::put('/update/{id}', [TrainingController::class,'update']);
    Route::delete('/delete/{id}', [TrainingController::class,'destroy']);
});
Route::prefix('training-user')->group(function () {
    Route::get('/list', [TrainingUserController::class,'index']);
    Route::get('/show/{id}', [TrainingUserController::class,'show']);
    Route::post('/create', [TrainingUserController::class,'store']);
    Route::put('/update/{id}', [TrainingUserController::class,'update']);
    Route::delete('/delete/{id}', [TrainingUserController::class,'destroy']);
});
Route::prefix('activity-calendar')->group(function () {
    Route::get('/list', [ActivityCalendarController::class,'index']);
    Route::get('/show/{id}', [ActivityCalendarController::class,'show']);
    Route::post('/create', [ActivityCalendarController::class,'store']);
    Route::put('/update/{id}', [ActivityCalendarController::class,'update']);
    Route::delete('/delete/{id}', [ActivityCalendarController::class,'destroy']);
});
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
Route::apiResource('activity-calendar', ActivityCalendarController::class);*/
#endregion