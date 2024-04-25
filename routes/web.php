<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// })->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/profile', [DashboardController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [DashboardController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [DashboardController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/adminauth.php';
require __DIR__ . '/admin.php';
