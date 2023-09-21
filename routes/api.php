<?php

use App\Http\Controllers\api\v1\AccessTokenController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\api\v1\ClassroomController;
use App\Http\Controllers\api\v1\ClassroomMessagesController;
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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {return $request->user();
    });
    Route::apiResource('/classrooms',ClassroomController::class);
    Route::apiResource('/classroom.classworks',ClassworkController::class);
    
    Route::get('/auth/access-token',[AccessTokenController::class,'index']);
    Route::delete('/auth/access-token/{id?}',[AccessTokenController::class,'destroy']);

    Route::apiResource('classroom.messages',ClassroomMessagesController::class);
});
Route::middleware('guest:sanctum')->group(function(){
   
    Route::post('/auth/access-token',[AccessTokenController::class,'createToken']);
});
