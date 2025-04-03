<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Portfolio\PortfolioController;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::group(['prefix' => 'dashboard'], function(){
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::group(['prefix' => 'portfolio'], function(){
    Route::get('list-of-doctors', [PortfolioController::class, 'listOfDoctors'])->name('portfolio.list');
    Route::match(['get', 'post'], 'create-doctors-portfolio', [PortfolioController::class, 'createDoctorsPortfolio'])->name('portfolio.create');
});
