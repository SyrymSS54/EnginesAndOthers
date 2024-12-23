<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\Auth\AuthController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Product\ProductCRUD;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\Seller\OrderStateController;

use Illuminate\Http\Request;
use App\Models\Seller\Statistics;
use App\Models\Product\ProductModel;
use Illuminate\Support\Facades\Auth;



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

Route::controller(StoreController::class)->group(function(){
    Route::post('/seller/store','get_list_store')->name('seller.store')->middleware('checkSeller');
    Route::post('/seller/store/create','create_store')->name('seller.store.create')->middleware('checkSeller');
    Route::post('/seller/store/item','get_item_store')->name('seller.store.item')->middleware('checkSeller');
    Route::post('/seller/store/product/list','get_list_product')->name('seller.store.product')->middleware('checkSeller');
});

Route::controller(OrderStateController::class)->group(function(){
    Route::post('/seller/order','get_orders')->middleware('checkSeller')->name('seller.order');
    
    Route::post('/seller/order/consideration','order_for_consideration')->middleware('checkSeller');
    Route::post('/seller/order/execution','order_for_execution')->middleware('checkSeller');
    Route::post('/seller/order/cancellation','order_on_cancellation')->middleware('checkSeller');
});

Route::post('/statistics',function(Request $request,Statistics $statistics,ProductModel $productModel){
    $stores = $statistics::where('seller_id',Auth::id())->get();
    foreach($stores as $key => $store)
        {
            $store['name'] = ProductModel::where("_id",$store['product'])->first(['name'])['name'];
            $stores[$key] = $store;
        }

    return response()->json($stores);

})->middleware('checkSeller');

