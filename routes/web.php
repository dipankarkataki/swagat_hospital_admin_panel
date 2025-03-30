<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portfolio\PortfolioController;

Route::get('/', function () {
    return view('pages.dashboard.dashboard');
});

Route::group(['prefix' => 'portfolio'], function(){
    Route::get('list-of-doctors', [PortfolioController::class, 'listOfDoctors'])->name('portfolio.list');
    Route::match(['get', 'post'], 'create-doctors-portfolio', [PortfolioController::class, 'createDoctorsPortfolio'])->name('portfolio.create');
});
