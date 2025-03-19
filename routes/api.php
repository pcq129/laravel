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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getapi', [TestController::class, 'getapi']);
Route::post('/adduser', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);


    //users-api

    //index user
    Route::get('/view-users', [userController::class, 'index']);

    //view user
    Route::get('/user', [userController::class, 'show']);

    //add user
    Route::post('/add-user', [userController::class, 'store']);

    //delete user
    Route::delete('/remove-user', [userController::class, 'destroy']);

    //update user
    Route::post('/update-user', [userController::class, 'update']);



    //items-apis

    //get all items
    Route::get('/all-items', [ItemController::class, 'index']);

    //add item
    Route::post('/add-item', [ItemController::class, 'store']);


    //view item
    Route::get('/item', [ItemController::class, 'show']);

    //delete item
    Route::delete('/remove-item', [ItemController::class, 'destroy']);

    //update item
    Route::post('/update-item', [ItemController::class, 'update']);



    //item-category apis

    //index item-categories
    Route::get('/view-item-categories', [ItemCategoryController::class, 'index']);

    //view item-category
    Route::get('/item-category', [ItemCategoryController::class, 'show']);

    //add item-category
    Route::post('/add-item-category', [ItemCategoryController::class, 'store']);

    //delete item-cateogory
    Route::delete('/remove-item-category', [ItemCategoryController::class, 'destroy']);

    //update item-cateogory
    Route::post('/update-item-category', [ItemCategoryController::class, 'update']);



    //modifier Group apis

    //index modifier-group
    Route::get('/view-modifier-group', [ModifierGroupController::class, 'index']);

    //add modifier-group
    Route::post('/add-modifier-group', [ModifierGroupController::class, 'store']);

    //view modifier-group
    Route::get('/modifier-group', [ModifierGroupController::class, 'show']);

    //delete modifier-group
    Route::delete('/remove-modifier-group', [ModifierGroupController::class, 'destroy']);

    //update modifier-group
    Route::post('/update-modifier-group', [ModifierGroupController::class, 'update']);


    //modifier apis

    //index modifier
    Route::get('/view-modifier', [ModifierController::class, 'index']);

    //add modifier
    Route::post('/add-modifier', [ModifierController::class, 'store']);

    //view modifier
    Route::get('/modifier', [ModifierController::class, 'show']);

    //delete modifier
    Route::delete('/remove-modifier', [ModifierController::class, 'destroy']);

    //update modifier
    Route::post('/update-modifier', [ModifierController::class, 'update']);

});
