<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\CourtCaseController;
use App\Http\Controllers\API\Auth\LoginController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [LoginController::class, 'logout']);

Route::post('/generate-token', [LoginController::class, 'generateToken']);

Route::post('/generate-otp', [LoginController::class, 'generateOTP']);

Route::middleware('auth:api')->get('/team-get-all', [TeamController::class, 'getAll']);

Route::middleware('auth:api')->get('/get-team-members', [TeamController::class, 'getTeamMembers']);

Route::middleware('auth:api')->get('/court-case-get-all', [CourtCaseController::class, 'getAll']);
