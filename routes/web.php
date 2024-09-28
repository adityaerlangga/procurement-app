<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ProductController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


Route::get('/', [UserController::class, 'login'])->name('login');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'signing']);
Route::get('/register', [UserController::class, 'register']);
Route::post('/register', [UserController::class, 'registering']);

Route::group(['middleware' => 'auth'], function () {
	Route::get('/logout', [UserController::class, 'logout']);
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	
	Route::prefix('users')->group(function () {
		Route::get('', [UserController::class, 'index']);
		Route::get('/create', [UserController::class, 'create']);
		Route::post('/create', [UserController::class, 'store']);
		Route::get('/{id}/edit', [UserController::class, 'edit']);
		Route::put('/{id}/edit', [UserController::class, 'update']);
		Route::delete('/{id}', [UserController::class, 'destroy']);
	});

	Route::prefix('vendors')->group(function () {
		Route::get('', [VendorController::class, 'index']);
		Route::post('/{id}/approve', [VendorController::class, 'approve']);
		Route::post('/{id}/reject', [VendorController::class, 'reject']);
	});

	Route::prefix('products')->group(function () {
		Route::get('', [ProductController::class, 'index']);
		Route::get('/create', [ProductController::class, 'create']);
		Route::post('/create', [ProductController::class, 'store']);
		Route::get('/{id}/edit', [ProductController::class, 'edit']);
		Route::put('/{id}/edit', [ProductController::class, 'update']);
		Route::delete('/{id}', [ProductController::class, 'destroy']);
	});
});


