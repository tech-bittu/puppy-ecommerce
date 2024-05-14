<?php

use App\Http\Controllers\AdminPanel\CategoryController;
use App\Http\Controllers\AdminPanel\PuppyController;
use App\Http\Controllers\AdminPanel\PuppyDescController;
use App\Http\Controllers\AdminPanel\SubCategoryController;
use App\Http\Controllers\AdminPanel\BrandsController;
use App\Http\Controllers\AdminPanel\ProductsController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::middleware([AdminAuth::class])->group(function () {
    Route::prefix('admin')->group(function () {
        // ##  *********************************** puppy info and overview controller
        Route::resource('/puppies', PuppyController::class);
        Route::resource('/puppiesdes', PuppyDescController::class);
        
        Route::post('/puppies/overview', [PuppyDescController::class, 'store'])->name('puppies.overview');
        Route::put('/puppydes/update', [PuppyDescController::class, 'update'])->name('puppydes.update');
        // Route::put('/puppiesdes/statusupdate', PuppyDescController::class);

        // ##  *********************************** Category controller
        Route::resource('/category',CategoryController::class);
        Route::get('/category/status/{id}',[CategoryController::class,'status'])->name('admin.category.status');
        // ##  *********************************** Sub Category controller
        Route::resource('/subcategory',SubCategoryController::class);
        Route::get('/subcategory/status/{id}',[SubCategoryController::class,'status'])->name('admin.subcategory.status');
        // ##  *********************************** Brand controller
        Route::resource('/brand',BrandsController::class);
        Route::get('/brand/status/{id}',[BrandsController::class,'status'])->name('admin.brand.status');
        // ##  *********************************** Product controller
        Route::resource('/products',ProductsController::class);
        Route::get('/products/status/{id}',[ProductsController::class,'status'])->name('admin.products.status');
    });
});
Route::post('/products/temp',[ProductsController::class,'temp'])->name('temp-images.create');
Route::get('/products/emptytemp',[ProductsController::class,'emptyTemp'])->name('temp.emptytemp');
