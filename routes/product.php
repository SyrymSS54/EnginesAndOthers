<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

Route::controller(ProductController::class)->group(function(){
    Route::get('/product','index')->name('product.card');
    Route::get('/product/search','search')->name('product.search');

    Route::post('/product/item','get_item')->name('product.item');
    Route::post('/product/search/list','get_search')->name('product.search.list');
});
