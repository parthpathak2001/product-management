<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');    
    Route::get('/products/{cat_id}', 'categoryDetails')->name('categoryDetails');
    Route::get('/product-details/{product_id}', 'productDetails')->name('productDetails');
});

Route::controller(CartController::class)->group(function () {
    Route::post('/add-to-cart', 'addToCart')->name('addToCart');
    Route::get('/cart', 'cart')->name('cart');
    Route::get('/destroy/{id}', 'destroy')->name('cartDestroy');
});


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::group(['as' => 'product.', 'prefix' => 'product'], function() {
            Route::get('/', 'index')->name('index');
            Route::post('/datatable', 'datatable')->name('data');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/destroy', 'destroy')->name('destroy');

            Route::post('/dropzone/fetch', 'dropzoneImageFetch')->name('dropzone.fetch');
            // Route::post('/dropzone/store', 'dropzoneImageStore')->name('dropzone.store');
            Route::post('/dropzone/destroy', 'dropzoneImageDelete')->name('dropzone.destroy');
        });
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::group(['as' => 'category.', 'prefix' => 'category'], function() {
            Route::get('/', 'index')->name('index');
            Route::post('/datatable', 'datatable')->name('data');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/destroy', 'destroy')->name('destroy');
        });
    });
});

