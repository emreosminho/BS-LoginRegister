<?php

use App\Http\Controllers\Api\ProductBrandController;
use App\Http\Controllers\Api\UserController;
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
