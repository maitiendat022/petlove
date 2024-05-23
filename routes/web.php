<?php

use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PetsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ReviewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiecesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Client\BookingController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ReviewController;

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

// Client::routes();
Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/product',[HomeController::class,'product'])->name('home.product');
Route::get('/product/{id}/detail',[HomeController::class,'detail'])->name('product.detail');

Route::middleware('authLogin')->group(function(){
    Route::middleware('role:2')->group(function(){
        Route::resource('cart', CartController::class);

        Route::prefix('user')->group(function (){
            Route::prefix('order')->group(function (){
                Route::get('/create',[OrderController::class,'create'])->name('order.create')->middleware('checkout');
                Route::post('/store',[OrderController::class,'store'])->name('order.store')->middleware('checkout');

                Route::get('/index',[OrderController::class,'index'])->name('user.order.index');
                Route::get('/{id}/show',[OrderController::class,'show'])->name('user.order.show');
                Route::post('/update',[OrderController::class,'update'])->name('user.order.update');
            });
            Route::prefix('booking')->group(function (){
                Route::get('/create',[BookingController::class,'create'])->name('booking.create');
                Route::post('/store',[BookingController::class,'store'])->name('booking.store');

                Route::get('/index',[BookingController::class,'index'])->name('user.booking.index');
                Route::get('/{id}/show',[BookingController::class,'show'])->name('user.booking.show');
                Route::post('/update',[BookingController::class,'update'])->name('user.booking.update');
            });
            Route::prefix('account')->group(function (){
                Route::get('/index',[AccountController::class,'index'])->name('user.account.index');
                Route::post('/change',[AccountController::class,'changePassword'])->name('user.account.changePassword');
                Route::post('/update',[AccountController::class,'update'])->name('user.account.update');
            });
            Route::prefix('review')->group(function (){
                Route::get('/index',[ReviewController::class,'index'])->name('user.review.index');
                Route::get('/reviewed',[ReviewController::class,'reviewed'])->name('user.review.reviewed');

                Route::get('/{id}/create',[ReviewController::class,'create'])->name('user.review.create');
                Route::post('/store',[ReviewController::class,'store'])->name('user.review.store');
            });
        });
    });
});

// Admin::routes();
Route::middleware('authLogin')->group(function(){
    Route::prefix('admin')->group(function () {
        Route::get('/home',[HomeAdminController::class, 'index'])->name('admin.index')->middleware('role:1,3,4,5');
        Route::resource('users', UsersController::class)->middleware('role:1');
        Route::resource('pets', PetsController::class)->middleware('role:1,4');
        Route::resource('categories', CategoriesController::class)->middleware('role:1,4');
        Route::resource('products', ProductsController::class)->middleware('role:1,4');
        Route::resource('servieces', ServiecesController::class)->middleware('role:1,4');
        Route::resource('customers', CustomersController::class)->middleware('role:5');
        Route::middleware('role:1,3')->group(function(){
            Route::prefix('orders')->group(function(){
                Route::get('/index',[OrdersController::class,'index'])->name('orders.index');
                Route::get('/{id}/show',[OrdersController::class,'show'])->name('orders.show');
                Route::post('/update',[OrdersController::class,'update'])->name('orders.update');
                Route::post('/cancel',[OrdersController::class,'cancel'])->name('orders.cancel');
            });
        });
        Route::middleware('role:1,3')->group(function(){
            Route::prefix('bookings')->group(function(){
                Route::get('/index',[BookingsController::class,'index'])->name('bookings.index');
                Route::get('/{id}/show',[BookingsController::class,'show'])->name('bookings.show');
                Route::post('/update',[BookingsController::class,'update'])->name('bookings.update');
                Route::post('/cancel',[BookingsController::class,'cancel'])->name('bookings.cancel');
            });
        });
        Route::middleware('role:1,5')->group(function(){
            Route::prefix('reviews')->group(function(){
                Route::get('/index',[ReviewsController::class,'index'])->name('reviews.index');
                Route::get('/{id}/show',[ReviewsController::class,'show'])->name('reviews.show');
                Route::post('/feedback',[ReviewsController::class,'feedback'])->name('reviews.feedback');
            });
        });
        Route::middleware('role:1,3,4,5')->group(function(){
            Route::prefix('account')->group(function(){
                Route::get('/index',[AccountsController::class,'index'])->name('admin.account.index');
                Route::post('/change',[AccountsController::class,'changePassword'])->name('admin.account.changePassword');
                Route::post('/update',[AccountsController::class,'update'])->name('admin.account.update');
            });
        });
    });
});

// Auth::routes();
Route::middleware('guest')->group(function(){
    Route::get('register',[AuthController::class,'registerIndex'])->name('auth.registerIndex');
    Route::post('register',[AuthController::class,'register'])->name('auth.register');

    Route::get('login',[AuthController::class,'loginIndex'])->name('auth.loginIndex');
    Route::post('login',[AuthController::class,'login'])->name('auth.login');
});
Route::get('logout',[AuthController::class,'logout'])->name('auth.logout');

