<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/check-near-stores', [App\Http\Controllers\UserStoreController::class, 'nearbyStores'])->name('nearby.stores');

//
Route::get('admin/login', [App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [App\Http\Controllers\AdminAuthController::class, 'login']);
Route::post('admin/logout', [App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/store', [App\Http\Controllers\StoreController::class, 'index'])->name('admin.store');
    Route::get('/admin/add-store', [App\Http\Controllers\StoreController::class, 'addStore']);
    Route::post('admin/save/store', [App\Http\Controllers\StoreController::class, 'saveStore']);
    Route::get('admin/edit-store/{id}', [App\Http\Controllers\StoreController::class, 'edit'])->name('store.edit');
    Route::put('admin/update/store/{id}', [App\Http\Controllers\StoreController::class, 'update'])->name('store.update');
    Route::delete('admin/delete/store/{id}', [App\Http\Controllers\StoreController::class, 'destroy'])->name('store.update');
});