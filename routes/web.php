<?php

use App\Models\master\CourtCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyLocationController;
use App\Http\Controllers\LoginDetailController;
use App\Http\Controllers\master\TeamController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\master\CourtCaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class);

    Route::get('/users/inactive/{id}',[UserController::class,'inactive'])->name('users.inactive');
    Route::get('/users/activate/{id}',[UserController::class,'activate'])->name('users.activate');
    Route::get('/users/resetpass/{id}',[UserController::class,'resetpass'])->name('users.resetpass');
    Route::resource('users', UserController::class);

    Route::get('/change-password',  [ChangePasswordController::class,'index'])->name('change.index');
    Route::post('/change-password', [ChangePasswordController::class,'store'])->name('change.password');

    Route::get('/logindetails',[LoginDetailController::class,'index'])->name('logindetails.index');

    Route::resource('teams', TeamController::class);

    Route::get('/court_cases/assign-view/{id}',[CourtCaseController::class,'addCourtCaseView'])->name('court_cases.assign_view');
    Route::post('/court_cases/assign-store/{court_case}',[CourtCaseController::class,'addCourtCaseStore'])->name('court_cases.assign_store');
    Route::resource('court_cases', CourtCaseController::class);

});
