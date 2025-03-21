<?php

use App\Modules\Foods\Controllers\GetFoodsController;
use App\Modules\Foods\Controllers\UpdateFoodsController;
use App\Modules\Foods\Controllers\DeleteFoodController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'products'], function(){
  Route::get('/', [GetFoodsController::class, 'getAll']);
  Route::get('/{foodId}', [GetFoodsController::class, 'getById']);
  Route::put('/{foodId}', [UpdateFoodsController::class, 'update']);
  Route::delete('/{foodId}', [DeleteFoodController::class, 'delete']);
});
