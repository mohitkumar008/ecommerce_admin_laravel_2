<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->group(function () {
    Route::any('/', [AdminController::class, 'login']);
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        Route::get('settings', [AdminController::class, 'settings']);
        Route::post('check-curr-pwd', [AdminController::class, 'check_curr_pwd']);
        Route::post('change-password', [AdminController::class, 'change_pwd']);
        Route::post('update-profile', [AdminController::class, 'update_profile']);
        Route::get('logout', [AdminController::class, 'logout']);

        //SectionController
        Route::get('section', [SectionController::class, 'index']);
        Route::get('section/{status}/{id}', [SectionController::class, 'change_status']);

        //CategoryController
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('categories/{status}/{url}/{id}', [CategoryController::class, 'change_status'])->name('status');
        Route::get('categories/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
        Route::any('categories/manage-category/{id?}', [CategoryController::class, 'manage_category'])->name('manageCategory');
        Route::post('append-category-level', [CategoryController::class, 'appendCategoryLevel']);
    });
});
