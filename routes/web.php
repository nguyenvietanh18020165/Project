<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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


Route::post('/api/check', [\App\Http\Controllers\CheckController::class, 'index']);
//Route::post('/test/register', [\App\Http\Controllers\Api\Auth\LoginController::class, 'register']);
Route::group(['prefix' => "/"], function(){
    Route::get("/", [App\Http\Controllers\HomeController::class, 'index']) -> name("home");
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index']);
});
Route::group(['prefix' => "admin"], function(){
    Route::get("/", [App\Http\Controllers\HomeController::class, 'admin']) -> name("admin")->middleware('admin');
});
Route::group(['prefix' => "product"], function(){
    Route::get("get",[ProductController::class,"getProduct"])->middleware("auth");
    Route::get("add",[ProductController::class,"create"])->middleware("admin");
    Route::post("add",[ProductController::class,"store"])->middleware("admin");
    Route::get("delete",[ProductController::class,"delProduct"])->middleware("admin");
    Route::get("edit/{id}",[ProductController::class,"editProductCreate"])->middleware("admin");
    Route::post("edit",[ProductController::class,"editProductStore"])->middleware("admin");
    Route::get("images/delete",[ProductController::class,"deleteImages"])->middleware("admin");
    Route::get("search",[ProductController::class,"searchProduct"]);
    Route::get("search-more",[ProductController::class,"getDataSearch"]);
    Route::post("name",[ProductController::class,"getNameProduct"]);
    Route::get("is_top",[ProductController::class,"ProductIsTop"]);

    Route::group(['prefix' => "cart"], function(){
        Route::get('add', [ProductController::class, 'addCart'])->middleware('auth');
        Route::get('detail', [ProductController::class, 'cartDetail'])->name('cart_detail')->middleware('auth');
        Route::get('delete', [ProductController::class, 'deleteCart'])->middleware('auth');
        Route::get('quality/get', [ProductController::class, 'getQuality'])->middleware('auth');
        Route::get('view-admin', [ProductController::class, 'viewCartAdmin'])->middleware('admin');
        Route::get('detail-card-of-user', [ProductController::class, 'detailCardOfUser'])->middleware('admin');
    });
    Route::group(['prefix' => "category"], function(){
        Route::get("/", [ProductController::class, 'getAllCtgr']);
        Route::get("name", [ProductController::class, 'getCategory']);
        Route::get("add", [ProductController::class, 'addCtgr'])->middleware('admin');
        Route::get("delete", [ProductController::class, 'deleteCtgr'])->middleware('admin');
    });
//    Route::get('api', [ProductController::class, 'ProductApi']);
    Route::get("/{slug}",[ProductController::class,"ProductDetail"])->name("product_detail");
});

Route::group(['prefix' => "category"], function(){
    Route::get("/", [CategoryController::class, 'index'])->name('category');
    Route::get("/product/{id}", [CategoryController::class, 'getProductInCtgr']);
});

Route::group(['prefix' => "like-product"], function(){
    Route::get("/", [LikeController::class, 'index'])->middleware('auth');
    Route::get("/user", [LikeController::class, 'likePrdUser'])->middleware('auth');
    Route::get("/{id}", [LikeController::class, 'likePrd'])->middleware('auth');
});

Route::group(['prefix' => "profile"], function(){
    Route::get('/', [UserController::class, 'profile'])->middleware('auth');
    Route::post('/update', [UserController::class, 'update'])->middleware('auth');
});

Route::group(['prefix' => "user"], function(){
    Route::get('/', [UserController::class, 'allUser'])->middleware('admin');
    Route::get('/all-vendor', [UserController::class, 'allVendor'])->middleware('admin');
    Route::get('/all-admin', [UserController::class, 'allAdmin'])->middleware('admin');
    Route::get('/all-order', [UserController::class, 'orderDetail'])->middleware('admin');
    Route::get('/is-admin/{id}', [UserController::class, 'isAdmin'])->middleware('admin');
    Route::get('/un-admin/{id}', [UserController::class, 'unAdmin'])->middleware('admin');
    Route::get('/is-vendor/{id}', [UserController::class, 'isVendor'])->middleware('admin');
    Route::get('/un-vendor/{id}', [UserController::class, 'unVendor'])->middleware('admin');
    Route::get('/reset-pass/{id}', [UserController::class, 'resetPass'])->middleware('admin');
    Route::get("/reset/{newPass}/{oldPass}", [UserController::class, 'resetPW']);
});
Route::group(['prefix' => "payment"], function(){
    Route::get('/order', [PaymentController::class, 'orders'])->middleware('auth');
    Route::post('/momo-atm', [PaymentController::class, 'momoAtm'])->middleware('auth');
    Route::get('/cancel', [PaymentController::class, 'cancel'])->middleware('auth');
    Route::get('/momo-check', [PaymentController::class, 'check'])->middleware('auth');
    Route::group(['prefix' => "/admin"], function(){
        Route::get('/active/{id}', [PaymentController::class, 'adminActive'])->middleware('admin');
        Route::get('/cancel/{id}', [PaymentController::class, 'adminCancel'])->middleware('admin');
        Route::get('/done/{id}', [PaymentController::class, 'adminDone'])->middleware('admin');
    });
});

Route::group(['prefix' => "tin-tuc"], function(){
    Route::get('', [BlogController::class, 'index']);
    Route::get('add', [BlogController::class, 'create']);
    Route::get('edit/{id}', [BlogController::class, 'editBlog']);
    Route::post('add', [BlogController::class, 'store']);
    Route::post('update/{id}', [BlogController::class, 'updateBlog']);
    Route::get('admin-show', [BlogController::class, 'showBlogAdmin']);
    Route::get('delete', [BlogController::class, 'deleteBlog']);
    Route::get('api-allblog', [BlogController::class, 'getBlogApi']);
    Route::group(['prefix' => "category"], function(){
        Route::get('/', [BlogController::class, 'CategoryDetail'])->middleware('admin');
        Route::get('/add', [BlogController::class, 'addCtgr'])->middleware('admin');
        Route::get('/delete', [BlogController::class, 'deleteCtgr'])->middleware('admin');
        Route::get('/{slug}', [BlogController::class, 'CtgrDetail']);
    });
    Route::get('/{slug}', [BlogController::class, 'blogDetail']);
});


Auth::routes();
