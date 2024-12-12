<?php

use App\Http\Controllers\Customer\Auth\AuthController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\OrderController;
use Illuminate\Support\Facades\Route;
use App\Models\Customer\CartModel;

Route::controller(AuthController::class)->group(function(){
    Route::get('/customer/auth/signin','index_signin')->name('customer.auth.get.signin');
    Route::get('/customer/auth/signup','index_signup')->name('customer.auth.get.signup');

    

    Route::post('/customer/auth/signin','signin')->name('customer.auth.post.signin');
    Route::post('/customer/auth/signup','signup')->name('customer.auth.post.signup');
});

Route::controller(CustomerController::class)->group(function(){
    Route::get('/customer/personal','index')->middleware('checkCustomer')->name('customer.personal');
    Route::post('/customer/auth/logout','logout')->middleware('checkCustomer')->name('customer.auth.logout');
}); 

Route::controller(CartController::class)->group(function(){
    Route::get('/customer/personal/cart','index')->middleware('checkCustomer')->name('customer.personal.cart');
    Route::post('/customer/cart','read')->middleware('checkCustomer')->name('customer.cart.read');
    Route::post('/customer/cart/check','check_cart')->name('check.cart');
    Route::post('/customer/cart/create','create')->middleware('checkCustomer')->name('cart.update');
    Route::post('/customer/cart/delete','delete')->middleware('checkCustomer')->name('cart.delete');

    Route::post('/cart/up','upSet')->middleware('checkCustomer')->name('cart.up');
    Route::post('/cart/down','downSet')->middleware('checkCustomer')->name('cart.down');
});

Route::controller(OrderController::class)->group(function(){
    Route::post('/order','read')->middleware('checkCustomer')->name('order.read');
    Route::post('/order/create','create')->middleware('checkCustomer')->name('order.create');
    Route::post('/order/update','update')->middleware('checkCustomer')->name('order.update');
    Route::post("/order/pay",'pay')->middleware('checkCustomer')->name('order.pay');
    Route::post("/order/history",'history')->middleware('checkCustomer');
});