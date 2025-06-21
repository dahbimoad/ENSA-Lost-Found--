<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Items routes
Route::resource('items', ItemController::class);

// Item status management routes (requires auth)
Route::middleware('auth')->group(function () {
    Route::patch('/items/{item}/resolve', [ItemController::class, 'markAsResolved'])->name('items.resolve');
    Route::patch('/items/{item}/reactivate', [ItemController::class, 'reactivate'])->name('items.reactivate');
});

// Dashboard route (requires auth)
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Profile routes (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes (requires auth and admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [\App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users');
    Route::get('/items', [\App\Http\Controllers\Admin\AdminController::class, 'items'])->name('items');
    Route::delete('/items/{item}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteItem'])->name('items.delete');
    Route::patch('/users/{user}/toggle-admin', [\App\Http\Controllers\Admin\AdminController::class, 'toggleUserAdmin'])->name('users.toggle-admin');
});

require __DIR__.'/auth.php';
