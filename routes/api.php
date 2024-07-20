<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\Auth\AuthController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);

Route::post('/generate-token', [AuthController::class, 'generateToken']);

Route::post('/generate-otp', [AuthController::class, 'generateOTP']);

Route::middleware('auth:api')->get('/team-get-all', [TeamController::class, 'getAll']);

Route::middleware('auth:api')->get('/get-team-members', [TeamController::class, 'getTeamMembers']);

Route::middleware('auth:api')->get('/get-user-detail', [TeamController::class, 'getUserDetail']);

Route::middleware('auth:api')->get('/court-case-get-all', [CourtCaseController::class, 'getAll']);

Route::middleware('auth:api')->get('/get-courtcase-detail', [CourtCaseController::class, 'getCourtCaseDetail']);

Route::middleware('auth:api')->get('/get-court-case-by-user', [CourtCaseController::class, 'getCourtCaseByUser']);
