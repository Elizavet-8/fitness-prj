<?php

use App\Http\Controllers\ProgramsController;
use Illuminate\Support\Facades\Route;

#region controllers usage
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivityCalendarController;
use App\Http\Controllers\TrainingUserController;
use App\Http\Controllers\FoodCalendarController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\PersonalAccountController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PhysicsParametersController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AccessHistoryController;
#endregion

Route::get("/", [MainPageController::class,'index'])->name('main');
Route::view("/diet","diet")->middleware('auth');
Route::view("/workout","workout")->middleware('auth');
Route::view("/plugin","plugin")->middleware('auth');
Route::view("/question", "question")->middleware('auth')->name('question');
Route::view("/article","article")->middleware('auth');
Route::get("/article/{id}", [ArticleController::class,'index']);
Route::post("/searchQuestions", [ArticleController::class,'searchQuestions'])->middleware('auth')->name('search');
Route::get("/search", [ArticleController::class,'search'])->middleware('auth');

Route::prefix('/admin')->group(function () {
    Route::get('/', function(){ return view('admin.dashboard.homepage'); });
    Route::prefix('/users')->group(function () {  // word: "icons" - not working as part of adress
        //Route::get('/', function(){         return view('admin.dashboard.admin.usersList'); });
        Route::get('/', [PersonalAccountController::class,'adminUsers'])->name('user');
    });
    Route::prefix('/menu')->group(function () {  // word: "icons" - not working as part of adress
        Route::get('/', [MenuController::class,'adminMenus'])->name('menu');
        Route::get('/edit/{id}', [MenuController::class,'adminShowMenu']);
        Route::post('/editMenu/{id}', [MenuController::class,'adminEditMenu'])->name('editMenu');
        Route::get('/add', [MenuController::class,'adminAddView']);
        Route::post('/addMenu', [MenuController::class,'adminAddMenu'])->name('addMenu');
        Route::delete('/remove/{id}', [MenuController::class, "deleteMenu"])->name('deleteMenu');
        Route::prefix('/days')->group(function () {
            Route::get('/{id}', [MenuController::class,'adminMenuDay'])->name('menuDay');
            Route::get('/edit/{id}', [MenuController::class,'adminShowMenuDay']);
            Route::post('/editMenuDay/{id}', [MenuController::class,'adminEditMenuDay'])->name('editMenuDay');
            Route::get('/add/{id}', [MenuController::class,'adminAddViewDay']);
            Route::post('/addMenuDay', [MenuController::class,'adminAddMenuDay'])->name('addMenuDay');
            Route::post('/deleteMenuDay/{id}', [MenuController::class,'adminDeleteMenuDay'])->name('deleteMenuDay');
        });
    });
    Route::prefix('/workout')->group(function () {  // word: "icons" - not working as part of adress
        Route::get('/', [TrainingController::class,'adminTrainings'])->name('training');
        Route::get('/edit/{id}', [TrainingController::class,'adminShowTraining']);
        Route::post('/editTraining/{id}', [TrainingController::class,'adminEditTraining'])->name('editTraining');
        Route::get('/add', [TrainingController::class,'adminAddView']);
        Route::post('/addTraining', [TrainingController::class,'adminAddTraining'])->name('addTraining');
        Route::post('/deleteTraining/{id}', [TrainingController::class,'adminDeleteTraining'])->name('deleteTraining');
        Route::prefix('/days')->group(function () {
            Route::get('/{id}', [TrainingController::class,'adminTrainingsDay'])->name('trainingDay');
            Route::get('/edit/{id}', [TrainingController::class,'adminShowTrainingDay']);
            Route::post('/editTrainingDay/{id}', [TrainingController::class,'adminEditTrainingDay'])->name('editTrainingDay');
            Route::get('/add', [TrainingController::class,'adminAddViewDay']);
            Route::post('/addTrainingDay', [TrainingController::class,'adminAddTrainingDay'])->name('addTrainingDay');
            Route::post('/deleteTrainingDay/{id}', [TrainingController::class,'adminDeleteTrainingDay'])->name('deleteTrainingDay');
        });
    });
    Route::prefix('/question')->group(function () {  // word: "icons" - not working as part of adress
        Route::get('/', [ArticleController::class,'adminArticles'])->name('adminQuestion');
        Route::get('/show/{id}', [ArticleController::class,'adminArticle']);
        Route::get('/edit/{id}', [ArticleController::class,'adminShowArticle']);
        Route::post('/editArticle/{id}', [ArticleController::class,'adminEditArticle'])->name('editArticle');
        Route::get('/add', [ArticleController::class,'adminAddView']);
        Route::post('/addArticle', [ArticleController::class,'adminAddArticle'])->name('addArticle');
        Route::post('/deleteArticle/{id}', [ArticleController::class,'adminDeleteArticle'])->name('deleteArticle');
    });
    Route::prefix('/program')->group(function () {  // word: "icons" - not working as part of adress
        Route::get('/', [ProgramsController::class, "openProgramsPage"])->name('openProgramsPage');
        Route::get('/edit/{id}', [ProgramsController::class, "openProgramEditingPage"])->name('openProgramEditingPage');
        Route::post('/edit/{id}', [ProgramsController::class, "editProgram"])->name('editProgram');
        Route::get('/add', [ProgramsController::class, "openAddingForm"])->name('openAddingForm');
        Route::post('/add', [ProgramsController::class, "addProgram"])->name('addProgram');
        Route::delete('/remove/{id}', [ProgramsController::class, "deleteProgram"])->name('deleteProgram');
    });
    Route::prefix('/main')->group(function () {  // word: "icons" - not working as part of adress
        Route::get('/', [MainPageController::class,'adminMagePage'])->name('adminMagePage');
        Route::post('/edit/{id}', [MainPageController::class,'adminEditContent']);
    });
    Route::prefix('notification')->group(function () {  // word: "icons" - not working as part of adress
        Route::get('/', [NotificationController::class,'list'])->name('notification');
        Route::delete('/remove/{id}', [NotificationController::class,'deleteNotification'])->name('notification.destroy');
        Route::get('/edit/{id}', [NotificationController::class,'adminShowNotification']);
        Route::post('/editNotification/{id}', [NotificationController::class,'editNotification'])->name('editNotification');
        Route::get('/add', [NotificationController::class,'adminAddView']);
        Route::post('/addNotification', [NotificationController::class,'addNotification'])->name('addNotification');
    });
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/upload/{id}', [FileController::class, 'upload'])->name('uploadIMG');

Route::prefix('api/personal-account')->group(function () {
    Route::get('/list', [PersonalAccountController::class,'index']);
    Route::get('/show/{id}', [PersonalAccountController::class,'show']);
    Route::post('/create', [PersonalAccountController::class,'store']);
    Route::put('/update/{id}', [PersonalAccountController::class,'update']);
    Route::delete('/delete/{id}', [PersonalAccountController::class,'destroy']);
});
Route::prefix('api/user-menu')->group(function () {
    Route::get('/list', [UserMenuController::class,'index']);
    Route::get('/show/{id}', [UserMenuController::class,'show']);
    Route::post('/create', [UserMenuController::class,'store']);
    Route::put('/update/{id}', [UserMenuController::class,'update']);
    Route::delete('/delete/{id}', [UserMenuController::class,'destroy']);
});
Route::prefix('api/food-calendar')->group(function () {
    Route::get('/list', [FoodCalendarController::class,'index']);
    Route::get('/show/{id}', [FoodCalendarController::class,'show']);
    Route::post('/create', [FoodCalendarController::class,'store']);
    Route::put('/update/{id}', [FoodCalendarController::class,'update']);
    Route::delete('/delete/{id}', [FoodCalendarController::class,'destroy']);
});
Route::prefix('api/training-user')->group(function () {
    Route::get('/list', [TrainingUserController::class,'index']);
    Route::get('/show/{id}', [TrainingUserController::class,'show']);
    Route::post('/create', [TrainingUserController::class,'store']);
    Route::put('/update/{id}', [TrainingUserController::class,'update']);
    Route::delete('/delete/{id}', [TrainingUserController::class,'destroy']);
});
Route::prefix('api/activity-calendar')->group(function () {
    Route::get('/list', [ActivityCalendarController::class,'index']);
    Route::get('/show/{id}', [ActivityCalendarController::class,'show']);
    Route::post('/create', [ActivityCalendarController::class,'store']);
    Route::put('/update/{id}', [ActivityCalendarController::class,'update']);
    Route::delete('/delete/{id}', [ActivityCalendarController::class,'destroy']);
});
Route::prefix('api/notification')->group(function () {
    Route::get('/list', [NotificationController::class,'index']);
    Route::get('/show/{id}', [NotificationController::class,'show']);
    Route::post('/create', [NotificationController::class,'store']);
    Route::put('/update/{id}', [NotificationController::class,'update']);
    Route::delete('/delete/{id}', [NotificationController::class,'destroy']);
});
Route::prefix('api/physics-parameter')->group(function () {
    Route::get('/list', [PhysicsParametersController::class,'index']);
    Route::get('/show/{id}', [PhysicsParametersController::class,'show']);
    Route::post('/create', [PhysicsParametersController::class,'store']);
    Route::put('/update/{id}', [PhysicsParametersController::class,'update']);
    Route::delete('/delete/{id}', [PhysicsParametersController::class,'destroy']);
});

Route::prefix('api/access-history')->group(function(){
    Route::get('/list', [AccessHistoryController::class,'index']);
    Route::get('/show/{id}', [AccessHistoryController::class,'show']);
    Route::post('/create', [AccessHistoryController::class,'store']);
    Route::put('/update/{id}', [AccessHistoryController::class,'update']);
    Route::delete('/delete/{id}', [AccessHistoryController::class,'destroy']);
});
