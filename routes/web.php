<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\StaticPageController;
use Illuminate\Support\Facades\Route;

Route::get('/',[StaticPageController::class,'home'])->name('home');

// })->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/account/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/account/dashboard',[StaticPageController::class,'dashboard'])->name('dashboard');
});
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/profile', [DashboardController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [DashboardController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [DashboardController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/adminauth.php';
require __DIR__ . '/admin.php';
