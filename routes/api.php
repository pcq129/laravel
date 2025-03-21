<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\ItemCategoryController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\ModifierController;
use App\Http\Controllers\API\ModifierGroupController;
use App\Http\Middleware\corsFix;
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
Route::get('/me', [AuthController::class, 'me']);









Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);



    Route::resource('/items', ItemController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/category', ItemCategoryController::class);
    Route::resource('/modifier-group', ModifierGroupController::class);
    Route::resource('/modifier', ModifierController::class);

    //users-api
    // Route::resource('/users', UserController::class);

    // //index user
    // Route::get('/users/index', [userController::class, 'index']);

    // //view user
    // Route::get('/user/show', [userController::class, 'show']);

    // //add user
    // Route::post('/user/add', [userController::class, 'store']);

    // //delete user
    // Route::delete('/user/remove', [userController::class, 'destroy']);

    // //update user
    // Route::post('/user/update', [userController::class, 'update']);



    //items-apis
    // Route::resource('/items', ItemController::class);


    // //get all items
    // Route::get('/items/index', [ItemController::class, 'index']);

    // //add item
    // Route::post('/items/store', [ItemController::class, 'store']);


    // //view item
    // Route::get('/items/show', [ItemController::class, 'show']);

    // //delete item
    // Route::delete('/items/destroy', [ItemController::class, 'destroy']);

    // //update item
    // Route::post('/items/update', [ItemController::class, 'update']);



    //item-category apis
    // Route::resource('/category', ItemCategoryController::class);

    //index item-categories
    // ('/category/index', [ItemCategoryController::class, 'index']);

    // //view item-category
    // Route::get('/category/show', [ItemCategoryController::class, 'show']);

    // //add item-category
    // Route::post('/category/store', [ItemCategoryController::class, 'store']);

    // //delete item-cateogory
    // Route::delete('/category/destroy', [ItemCategoryController::class, 'destroy']);

    // //update item-cateogory
    // Route::post('/category/update', [ItemCategoryController::class, 'update']);



    //modifier Group apis
    // Route::resource('/modifier-group', ModifierGroupController::class);


    // //index modifier-group
    // Route::get('/view-modifier-group', [ModifierGroupController::class, 'index']);

    // //add modifier-group
    // Route::post('/add-modifier-group', [ModifierGroupController::class, 'store']);

    // //view modifier-group
    // Route::get('/modifier-group', [ModifierGroupController::class, 'show']);

    // //delete modifier-group
    // Route::delete('/remove-modifier-group', [ModifierGroupController::class, 'destroy']);

    // //update modifier-group
    // Route::post('/update-modifier-group', [ModifierGroupController::class, 'update']);


    //modifier apis
    // Route::resource('/modifier', ModifierController::class);

    // //index modifier
    // Route::get('/view-modifier', [ModifierController::class, 'index']);

    // //add modifier
    // Route::post('/add-modifier', [ModifierController::class, 'store']);

    // //view modifier
    // Route::get('/modifier', [ModifierController::class, 'show']);

    // //delete modifier
    // Route::delete('/remove-modifier', [ModifierController::class, 'destroy']);

    // //update modifier
    // Route::post('/update-modifier', [ModifierController::class, 'update']);

});
