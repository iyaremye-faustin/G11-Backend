<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Api\CommunityController;


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

Route::get('/welcome',[\App\Http\Controllers\Welcome\MessageController::class,'index']);

Route::group(['prefix' => 'user'], function()
{
    Route::post('/register',[RegistrationController::class,'register']);
    Route::middleware(['auth:sanctum', 'isAdmin'])->get('/{user}/role',[\App\Http\Controllers\Roles\UserRole::class,'index']);
    Route::post('/login',[\App\Http\Controllers\Auth\Login::class,'index']);
    Route::middleware('auth:sanctum')->post('/logout',[\App\Http\Controllers\Auth\Logout::class,'logout']);
});

Route::get('/users',[\App\Http\Controllers\Auth\Users::class,'index'])->middleware('auth:sanctum');
Route::group(['prefix'=>'role'],function(){
    Route::middleware(['auth:sanctum', 'isAdmin'])->put('assignRole',[\App\Http\Controllers\Roles\UserRole::class,'assignRole']);
});
Route::group(['prefix'=>'community'],function(){
    Route::middleware(["auth:sanctum","isAdmin"])->post('register',[\App\Http\Controllers\Api\CommunityController::class,'register']);
});


