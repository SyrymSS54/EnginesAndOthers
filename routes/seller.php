<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\Auth\AuthController;
use App\Http\Controllers\Seller\SellerController;
use App\Models\Product\ProductModel;
use App\Http\Controllers\Product\ProductCRUD;
use App\Http\Controllers\Product\ProductController;

Route::controller(AuthController::class)->group(function(){
    Route::get('/seller/auth/signin','index_signin')->name('seller.auth.get.signin');
    Route::get('/seller/auth/signup','index_signup')->name('seller.auth.get.signup');

    Route::post('/seller/auth/signin','signin')->name('seller.auth.post.signin');
    Route::post('/seller/auth/signup','signup')->name('seller.auth.post.signup');
});

Route::controller(SellerController::class)->group(function(){
    Route::get('/seller','index')->middleware('checkSeller')->name('seller.personal');
});

Route::controller(ProductCRUD::class)->group(function(){
    Route::post('/seller/product/create','create')->middleware('checkSeller');
    Route::post('/seller/product/read','read')->can('seller','productModel');
    Route::post('/seller/product/update','update')->can('update','productModel');
    Route::post('/seller/product/')->can('update','productModel');
});