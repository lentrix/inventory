<?php

use Illuminate\Support\Facades\Route;
use App\Models\Item;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SiteController::class, 'home']);

Route::get('/login', [SiteController::class, 'loginForm'])->name('login');
Route::post('/login',[SiteController::class, 'login']);

Route::group(['middleware'=>'auth'], function(){

    Route::post('/logout', [SiteController::class, 'logout']);


    Route::get('/items', [ItemController::class,'index']);

    Route::get('/users/create',[UserController::class,'create']);
    Route::get('/users/edit/{user}', [UserController::class, 'edit']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::post('/users',[UserController::class, 'store']);
    Route::get('/users', [UserController::class,'index']);

    Route::put('/offices/{office}',[OfficeController::class, 'update']);
    Route::post('/offices',[OfficeController::class, 'store']);
    Route::get('/offices', [OfficeController::class,'index']);
});


