<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\ItemCategoryController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\ModifierController;
use App\Http\Controllers\API\ModifierGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::resource('/items', ItemController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/category', ItemCategoryController::class);
    Route::resource('/modifier-group', ModifierGroupController::class);
    Route::resource('/modifier', ModifierController::class);
});
