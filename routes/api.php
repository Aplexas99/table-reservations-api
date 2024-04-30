<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoachClientController;
use App\Http\Controllers\TrainingBlockController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ExerciseController;
// CORS
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH, DELETE');
// header('Access-Control-Allow-Headers: Authorization, Content-Type');

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

/*
 If a route does not work, try stopping the server, running php artisan route:clear in the console, and starting the server again before trying anything else
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('training-blocks', [TrainingBlockController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user-details', [AuthController::class, 'userDetails']);
    Route::get('users', [UserController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::resource('workouts', WorkoutController::class);
    Route::resource('exercises', ExerciseController::class);
    Route::get('clients/{clientId}/training-blocks', [TrainingBlockController::class, 'getTrainingBlocksForClient']);
    Route::get('coaches/{coachId}/clients', [CoachClientController::class, 'getClientsForCoach']);
});