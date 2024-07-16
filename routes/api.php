<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ReservationController;

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

Route::get('register', [AuthController::class, 'registerAdmin']);
Route::post('login', [AuthController::class, 'login']);

Route::get('users', [UserController::class, 'index']);
Route::get('tables', [TableController::class, 'index']);

Route::get('events/upcoming', [EventController::class, 'getUpcomingEvents']);
Route::get('events/{event}/reservations', [EventController::class, 'getReservations']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user-details', [AuthController::class, 'userDetails']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::resource('events', EventController::class);
    Route::resource('users', UserController::class);
    Route::resource('reservations', ReservationController::class);

});