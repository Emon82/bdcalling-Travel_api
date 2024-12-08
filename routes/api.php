<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SeedTravelDataController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Backend\CombinedTravelController;
use App\Http\Controllers\Api\Backend\RapidFlightController;
use App\Http\Controllers\Api\Backend\TravelController;
use App\Http\Controllers\Api\Backend\TrainController;
use App\Http\Controllers\Api\Backend\GoogleTestController;
use App\Http\Controllers\Api\Backend\CombineController;
use App\Http\Controllers\Api\Backend\CityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// routes/api.php






// Route::get('travel/search', [SeedTravelDataController::class, 'search']);


Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'status' => 'success',
        'message' => 'User retrieved successfully',
        'data' => $request->user(),
    ], 200); // The 200 is the HTTP status code
});
Route::middleware('auth:sanctum')->post('/logout', [LogoutController::class, 'logout']);
Route::get('/amadeus/token', [TravelController::class, 'getAccessToken']);
Route::post('/amadeus/search-flights', [TravelController::class, 'searchFlights']);
Route::post('/search-travel', [CombinedTravelController::class, 'getCombinedTravelInfo']);
Route::post('/getRoutes', [GoogleTestController::class, 'getRoutes']);
Route::get('/city/{city}', [CityController::class, 'getCityData']);