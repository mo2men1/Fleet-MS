<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TripController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cities', [CityController::class, 'index']);
Route::get('/trips', [TripController::class, 'index']);
Route::get('/trips/search', [TripController::class, 'search']);
Route::get('/trips/{trip}', [TripController::class, 'get']);
Route::post('/trips/{trip}/reserve', [TripController::class, 'reserve']);
