<?php

use App\Http\Controllers\Frontend\AppointmentBookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\DepartmentController;
use App\Http\Controllers\Frontend\HospitalController;
use App\Http\Controllers\Frontend\LabTestController;
use App\Http\Controllers\Frontend\PhoneNumberController;
use App\Http\Controllers\Frontend\PortfolioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/* Public Routes */

Route::group(['prefix' => 'hospital'], function(){
    Route::get('list-of-hospitals', [HospitalController::class, 'getListOfHospitals']);
});

Route::group(['prefix' => 'portfolio'], function(){
    Route::get('get-by-linked-hospital/{id}', [PortfolioController::class, 'getByLinkedHospital']);
    Route::get('get-by-id/{id}', [PortfolioController::class, 'getPortfolioById']);
});
Route::group(['prefix' => 'department'], function(){
    Route::get('list', [DepartmentController::class, 'listOfDepartments']);
});

Route::group(['prefix' => 'lab-test'], function(){
    Route::get('categories', [LabTestController::class, 'getLabTestCategories']);
    Route::get('list-of-tests-by-category/{id}', [LabTestController::class, 'listOfTestByCategory']);
    Route::get('lab-test-details-by-id/{id}', [LabTestController::class, 'labTestDetailsById']);
});

Route::group(['prefix' => 'guest'], function(){
    Route::group(['prefix' => 'phone-number'], function(){
        Route::post('send-otp', [PhoneNumberController::class, 'sendOTP'])->middleware('throttle:1,1');
        Route::post('verify-otp', [PhoneNumberController::class, 'verifyOTP']);
    });
});

Route::group(['prefix' => 'booking'], function(){
    Route::post('save-booking-details', [AppointmentBookingController::class, 'saveBookingDetails']);
    Route::post('generate-booking-pdf', [AppointmentBookingController::class, 'generateBookingPdf']);
});
