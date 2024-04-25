<?php

use App\Http\Controllers\AdminPanel\PuppyController;
use App\Http\Controllers\AdminPanel\PuppyDescController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::resource('/puppies', PuppyController::class);

    Route::resource('/puppiesdes', PuppyDescController::class);

    Route::post('/puppies/overview', [PuppyDescController::class, 'store'])->name('puppies.overview');
    Route::put('/puppydes/update', [PuppyDescController::class, 'update'])->name('puppydes.update');
    // Route::put('/puppiesdes/statusupdate', PuppyDescController::class);
});
