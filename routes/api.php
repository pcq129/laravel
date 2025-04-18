<?php

use App\Http\Controllers\API\AuthController;
// use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\ItemCategoryController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\ModifierController;
use App\Http\Controllers\API\ModifierGroupController;
use App\Http\Controllers\API\SectionController;
// use App\Http\Middleware\Authenticate;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TableController;
use App\Http\Controllers\API\TaxFeeController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\OrderController;
use App\Models\Section;

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

Route::post('/login', [AuthController::class, 'login'], true)->name('login');

// add in [] in middleware group to implement
Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/categorylist', [ItemCategoryController::class, 'getList']);
    // Route::get('/modifier-mapper', [ModifierController::class, 'getMapper']);
    Route::get('/modifier-group-list', [ModifierController::class, 'getList']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::resource('/item', ItemController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/category', ItemCategoryController::class);
    Route::resource('/modifier-group', ModifierGroupController::class);
    Route::resource('/modifier', ModifierController::class);
    Route::resource('/section',SectionController::class);
    Route::resource('/table',TableController::class);
    Route::resource('/tax-fees',TaxFeeController::class);
    Route::resource('/order',OrderController::class);
    Route::resource('/customers',CustomerController::class);
    Route::get('/sectionstable/{id}',[TableController::class, 'indexBySection']);
    Route::get('/waiting-tokens',[SectionController::class, 'waiting_token']);
    Route::put('/tax-fees-toggle/{id}',[TaxFeeController::class, 'toggle']);
    Route::post('/upload-image',[ItemController::class, 'image']);
    Route::delete('/upload-image/{image}',[ItemController::class, 'removeImage']);
    Route::post('/customer/assign-table', [CustomerController::class, 'assign_table']);
    Route::post('/customer/waiting-token', [CustomerController::class, 'create_waiting_token']);
    Route::post('/customer/update-waiting-token', [CustomerController::class, 'update_waiting_token']);
    Route::post('order/{id}', [OrderController::class, 'complete_order']);
    Route::put('order', [OrderController::class, 'cancel_order']);
    Route::post('customer/search', [CustomerController::class, 'searchCustomer']);
});
