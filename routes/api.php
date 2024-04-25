<?php

use App\Http\Controllers\API\PuppyApiController;
use App\Http\Controllers\API\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;

Route::prefix('admin')->group(function(){
    Route::apiResource('/api',UserApiController::class);
    Route::post('/puppylist',[PuppyApiController::class,'list']);
    // Route::post('/puppylist',[PuppyApiController::class,'list'])->middleware([AdminAuth::class]);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');