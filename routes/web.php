<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Hospital\HospitalController;
use App\Http\Controllers\OpdTiming\OpdTimingController;
use App\Http\Controllers\Portfolio\PortfolioController;
use App\Http\Controllers\Portfolio\RecentEvents\PortfolioRecentEventsController;

Route::match(['get', 'post',], '/', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function(){

    Route::group(['prefix' => 'dashboard'], function(){
        Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
    });

    Route::group(['prefix' => 'portfolio'], function(){
        Route::get('list-of-doctors', [PortfolioController::class, 'listOfDoctors'])->name('portfolio.list');
        Route::match(['get', 'post'], 'create-doctors-portfolio', [PortfolioController::class, 'createDoctorsPortfolio'])->name('portfolio.create');
        Route::get('portfolio-by-id/{id}', [PortfolioController::class, 'portfolioById'])->name('portfolio.by.id');
        Route::post('edit-portfolio/{id}', [PortfolioController::class, 'editPortfolio'])->name('portfolio.edit');
        Route::get('delete-portfolio/{id}', [PortfolioController::class, 'deletePortfolio'])->name('portfolio.delete');
        Route::post('update-portfolio-status', [PortfolioController::class, 'updatePortfolioStatus'])->name('portfolio.status.update');
        Route::post('update-appointment-status', [PortfolioController::class, 'updateAppointmentStatus'])->name('appointment.status.update');
        Route::group(['prefix' => 'hospital'], function(){
            Route::get('list-of-linked-hospitals', [PortfolioController::class, 'listOfLinkedHospitals'])->name('portfolio.linked.hospital.list');
            Route::match(['get', 'post'], 'assign', [PortfolioController::class, 'linkHospitalWithPortfolio'])->name('portfolio.hospital.assign');
            Route::get('linked-portfolio-by-id/{id}', [PortfolioController::class, 'getPortfolioLinkedHospitalsById'])->name('portfolio.linked.hospital.by.id');
            Route::get('edit-linked-hospital/{id}', [PortfolioController::class, 'editLinkedHospital'])->name('portfolio.edit.linked.hospital');
            Route::post('save-linked-edited-hospital', [PortfolioController::class, 'saveLinkedEditedHospital'])->name('portfolio.save.linked.edited.hospital');
            Route::post('update-linked-hospital-status', [PortfolioController::class, 'updateLinkedHospitalStatus'])->name('portfolio.update.linked.hospital.status');
        });
        Route::group(['prefix' => 'recent-events'], function(){
            Route::match(['get', 'post'], 'create-event', [PortfolioRecentEventsController::class, 'createEvent'])->name('portfolio.recent.events.create');
        });
    });

    Route::group(['prefix' => 'opd'], function(){
        Route::get('list-of-schedules', [OpdTimingController::class, 'listOfSchedules'])->name('opd.get.list.of.schedules');
        Route::match(['get', 'post'], 'set-schedule', [OpdTimingController::class, 'setOpdDateAndTime'])->name('opd.set.schedule');
        Route::get('schedule-by-id/{id}', [OpdTimingController::class, 'getOpdScheduleById'])->name('opd.get.schedule.by.id');
        Route::post('edit-schedule', [OpdTimingController::class, 'editSchedule'])->name('opd.edit.schedule');
        Route::post('update-schedule-status', [OpdTimingController::class, 'updateScheduleStatus'])->name('opd.update.schedule.status');
    });

    Route::group(['prefix' => 'hospital'], function(){
        Route::get('list-of-hospitals', [HospitalController::class, 'listOfHospitals'])->name('hospital.list');
        Route::match(['get', 'post'], 'create-hospital', [HospitalController::class, 'createHospital'])->name('hospital.create');
        Route::get('hospital-by-id/{id}', [HospitalController::class, 'hospitalById'])->name('hospital.by.id');
        Route::post('edit-hospital', [HospitalController::class, 'editHospital'])->name('hospital.edit');
        Route::get('delete-hospital/{id}', [HospitalController::class, 'deleteHospital'])->name('hospital.delete');
        Route::post('update-hospital-status', [HospitalController::class, 'updateHospitalStatus'])->name('hospital.status.update');
    });

    Route::get('logout', function(){
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    })->name('logout');
});

