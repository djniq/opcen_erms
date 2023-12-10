<?php

use App\Http\Controllers\API\AmbulanceController;
use App\Http\Controllers\API\DriverController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\HealthFacilityController;
use App\Http\Controllers\API\IncidentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('register', [UserController::class, 'register']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('/user/list', [UserController::class, 'list']);
    Route::apiResource('/user', UserController::class);

    Route::get('/health-facility/counters', [HealthFacilityController::class, 'counters']);
    Route::get('/health-facility/counters/:id', [HealthFacilityController::class, 'countersPerFacility']);
    Route::get('/health-facility/options', [HealthFacilityController::class, 'assignablehealthFacilities']);
    Route::apiResource('/health-facility', HealthFacilityController::class);
    
    Route::apiResource('/ambulance', AmbulanceController::class);
    Route::apiResource('/driver', DriverController::class);
    Route::apiResource('/incident', IncidentController::class);
});
