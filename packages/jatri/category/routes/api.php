<?php

use Illuminate\Support\Facades\Route;
use Jatri\Http\Controllers\Api\CategoryController;

Route::controller(CategoryController::class)->prefix('category')->group(function(){
    Route::post('store','store');
    Route::post('update','update');
    Route::post('delete','delete');
});

?>