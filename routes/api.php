<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\DepartmentController;
use App\Http\Controllers\Frontend\LabTestController;
use App\Http\Controllers\Frontend\PortfolioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/* Public Routes */

Route::group(['prefix' => 'portfolio'], function(){
    Route::get('list', [PortfolioController::class, 'listOfDoctors']);
});
Route::group(['prefix' => 'department'], function(){
    Route::get('list', [DepartmentController::class, 'listOfDepartments']);
});

Route::group(['prefix' => 'lab-test'], function(){
    Route::get('categories', [LabTestController::class, 'getLabTestCategories']);
    Route::get('list-of-tests-by-category/{id}', [LabTestController::class, 'listOfTestByCategory']);
    Route::get('lab-test-details-by-id/{id}', [LabTestController::class, 'labTestDetailsById']);
});
