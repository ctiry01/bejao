<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RequestVehicleController;

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

/*Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->post('/vehicle', [VehicleController::class, 'store']);
Route::middleware('auth:sanctum')->post('/vehicle/enable', [VehicleController::class, 'enable']);
Route::middleware('auth:sanctum')->post('/vehicle/disable', [VehicleController::class, 'disable']);
Route::middleware('auth:sanctum')->post('/vehicle/remove', [VehicleController::class, 'remove']);

Route::middleware('auth:sanctum')->post('/request-vehicle', [RequestVehicleController::class, 'index']);

