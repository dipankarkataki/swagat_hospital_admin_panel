<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Portfolio\PortfolioController;

Route::match(['get', 'post',], '/', [LoginController::class, 'login'])->name('login');

Route::group(['prefix' => 'dashboard'], function(){
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'portfolio'], function(){
        Route::get('list-of-doctors', [PortfolioController::class, 'listOfDoctors'])->name('portfolio.list');
        Route::match(['get', 'post'], 'create-doctors-portfolio', [PortfolioController::class, 'createDoctorsPortfolio'])->name('portfolio.create');
    });
    
    Route::get('logout', function(){
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    })->name('logout');
});

