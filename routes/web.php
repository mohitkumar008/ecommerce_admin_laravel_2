<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductAttrController;
use App\Http\Controllers\Admin\ProdcutImageController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\BrandController;

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
        //AdminController
        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard', 'dashboard');
            Route::get('settings', 'settings');
            Route::post('check-curr-pwd', 'check_curr_pwd');
            Route::post('change-password', 'change_pwd');
            Route::post('update-profile', 'update_profile');
            Route::get('logout', 'logout');
        });

        //SectionController
        Route::controller(SectionController::class)->group(function () {
            Route::get('section', 'index');
            Route::get('section/{status}/{id}', 'change_status');
        });

        //CategoryController
        Route::controller(CategoryController::class)->group(function () {
            Route::get('categories', 'index');
            Route::post('category/changeStatus', 'change_status');
            Route::post('category/deleteCategory', 'deleteCategory');
            Route::any('categories/manage-category/{id?}', 'manage_category')->name('manageCategory');
            Route::post('append-category-level', 'appendCategoryLevel');
        });

        //ProductController
        Route::controller(ProductController::class)->group(function () {
            Route::get('products', 'index');
            Route::post('products/changeStatus', 'change_status');
            Route::post('products/deleteProduct', 'deleteProduct');
            Route::any('products/manage-product/{id?}', 'manage_product')->name('manageProduct');
        });

        // ProdcutImageController
        Route::controller(ProdcutImageController::class)->group(function () {
            Route::any('products/addGallery/{id?}', 'addGallery')->name('addGallery');
            Route::post('products/replaceGalleryImage', 'replaceImage');
            Route::post('products/deleteGalleryImage', 'deleteImage');
        });

        //ProductAttrController
        Route::controller(ProductAttrController::class)->group(function () {
            Route::any('products/add-attribute/{id?}', 'addAttribute')->name('addAttribute');
            Route::post('products/deleteAttr', 'deleteAttribute');
        });

        //CouponController
        Route::controller(CouponController::class)->group(function () {
            Route::get('coupons', 'index');
            Route::post('coupon/changeStatus', 'change_status');
            Route::post('coupon/deleteCoupon', 'deleteCoupon');
            Route::any('coupon/manage-coupon/{id?}', 'manage_coupon')->name('manageCoupon');
        });

        //BrandController
        Route::controller(BrandController::class)->group(function () {
            Route::get('brands', 'index');
            Route::post('brand/changeStatus', 'change_status');
            Route::post('brand/deleteBrand', 'deleteBrand');
            Route::any('brand/manage-brand/{id?}', 'manage_brand')->name('manageBrand');
        });

        Route::fallback(function () {
            return view('admin.404');
        });
    });
});
