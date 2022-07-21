<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/welcome',[\App\Http\Controllers\Welcome\MessageController::class,'index']);
Route::post('/register',[RegistrationController::class,'register']);

Route::group(['prefix' => 'user'], function()
{
    Route::post('/login',[\App\Http\Controllers\Auth\Login::class,'index']);
});
