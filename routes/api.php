<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Auxilliary routes
Route::post('/create/department', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/create/designation', [DesignationController::class, 'create'])->name('designation.create');
Route::get('/departments', [DepartmentController::class, 'all'])->name('department.all');
Route::get('/designations', [DesignationController::class, 'all'])->name('designation.all');
// Auth Routes Begin here
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::group(['middleware'=> 'auth:sanctum'], function() {

   Route::put('/user/profile/update', [ProfileController::class, 'update'])->name('user.profile-update');
   Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});



