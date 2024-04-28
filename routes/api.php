<?php

use App\Http\Controllers\API\PuppyApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\SubcategoryApiController;
use App\Http\Controllers\API\BrandApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;

Route::prefix('admin')->group(function(){
    Route::apiResource('/api',UserApiController::class);
    Route::post('/puppylist',[PuppyApiController::class,'list']);
    Route::post('/categorylist',[CategoryApiController::class,'list']);
    Route::post('/subcategorylist',[SubcategoryApiController::class,'list']);
    Route::post('/brandlist',[BrandApiController::class,'list']);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
