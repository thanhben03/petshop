<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientHomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\CheckLoginMiddleware;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => CheckLoginMiddleware::class,
], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/purchased', [CartController::class, 'showProductPurchased'])->name('purchased');
    Route::get('/cart/confirm_cart', [ApiProductController::class, 'confirmCart'])->name('confirmCart');
    Route::post('/cart/add_address', [AccountController::class, 'addAddress'])->name('addAddress');
    Route::post('/account/check_exist_address', [AccountController::class, 'checkExistAddress'])->name('checkExistAddress');

    Route::get('/profile/password', [AccountController::class, 'password'])->name('password');
    Route::get('/profile/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/profile/change_password', [AccountController::class, 'changePassword'])->name('changePassword');
    Route::get('/profile/address', [AccountController::class, 'address'])->name('address');
    Route::get('/profile/wishlist', [AccountController::class, 'wishlist'])->name('wishlist');
    Route::get('/product/wishlist/{idProduct}', [ApiProductController::class, 'wishProduct'])->name('product.api.wishlist');
});
Route::post('/product/add', [ApiProductController::class, 'addProduct'])->name('product.api.add');
Route::get('/product/update/{id}/{action}', [ApiProductController::class, 'updateProduct'])->name('product.api.update');
Route::get('/product/delete/{id}', [ApiProductController::class, 'deleteProduct'])->name('product.api.delete');
Route::get('/', [ClientHomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'processLogin'])->name('processLogin');
Route::post('/register', [AuthController::class, 'processRegister'])->name('processRegister');
Route::get('/home/product/{id}', [ClientHomeController::class, 'detailProduct'])->name('view-product');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
// Route::get('/admin/product',[AdminProductController::class,'index'])->name('admin.product');
Route::resource('/admin/product', AdminProductController::class);


Route::get('/product/api', [AdminProductController::class, 'api'])->name('product.api');


// ADMIN ORDER CONTROLLER
Route::resource('/admin/order', AdminOrderController::class);
Route::get('/order/api', [AdminOrderController::class, 'api'])->name('order.api');


// PAYMENT
Route::get('/payment', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/pay', [PaymentController::class, 'pay'])->name('payment.pay');
Route::post('/payment/create_pay', [PaymentController::class, 'create_pay'])->name('payment.create_pay');
// Route::post('/payment/create_pay', [PaymentController::class, 'create_pay'])->name('payment.create_pay');
Route::get('/payment/pay_return', [PaymentController::class, 'pay_return'])->name('payment.pay_return');

Route::get('/destroyss', function () {
    session()->flush();
});

Route::get('/testss', function () {
    // session()->put('confirm_address',0);
    dd(route('order.edit'));
});
