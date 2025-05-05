<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PortfolioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/* Public Routes */

Route::group(['prefix' => 'portfolio'], function(){
    Route::get('list', [PortfolioController::class, 'listOfDoctors']);
});