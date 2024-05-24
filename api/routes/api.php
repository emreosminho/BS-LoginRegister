<?php

use App\Http\Controllers\Api\ProductBrandController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WarehouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(['prefix'=>'auth','as'=>'auth.'],function (){
    Route::post('login',[UserController::class,'login']);
    Route::post('register',[UserController::class,'register']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});

Route::group(['prefix'=>'catalog','as'=>'catalog.'],function (){
    Route::get('productbrand/index',[ProductBrandController::class,'index']);
    Route::post('productbrand/store',[ProductBrandController::class,'store']);
    Route::put('productbrand/{id}/update',[ProductBrandController::class,'update']);
    Route::delete('productbrand/{id}/delete',[ProductBrandController::class,'delete']);

});

Route::group(['prefix'=>'catalog','as'=>'catalog.'],function (){
    Route::get('product/index',[ProductsController::class,'index']);
    Route::post('product/store',[ProductsController::class,'store']);
    Route::put('product/{stock_code}/update',[ProductsController::class,'update']);
    Route::delete('product/{stock_code}/delete',[ProductsController::class,'delete']);

});

Route::group(['prefix'=>'catalog','as'=>'catalog.'],function (){
    Route::get('warehouse/index',[WarehouseController::class,'index']);
    Route::post('warehouse/store',[WarehouseController::class,'store']);
    Route::put('warehouse/{id}/update',[WarehouseController::class,'update']);
    Route::delete('warehouse/{id}/delete',[WarehouseController::class,'delete']);

});
