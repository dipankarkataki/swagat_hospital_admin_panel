<?php

use App\Http\Controllers\Academic\AcademicAnnouncementController;
use App\Http\Controllers\Appointment\AppointmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Hospital\HospitalController;
use App\Http\Controllers\LabTest\LabTestCategoryController;
use App\Http\Controllers\LabTest\LabTestController;
use App\Http\Controllers\LabTest\LabTestPackageController;
use App\Http\Controllers\OpdTiming\OpdTimingController;
use App\Http\Controllers\PopupManager\PopupController;
use App\Http\Controllers\Portfolio\PortfolioController;
use App\Http\Controllers\Portfolio\RecentEvents\PortfolioRecentEventsController;

Route::match(['get', 'post',], '/', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function(){

    Route::group(['prefix' => 'dashboard'], function(){
        Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
    });

    Route::group(['prefix' => 'hospital'], function(){
        Route::get('list-of-hospitals', [HospitalController::class, 'listOfHospitals'])->name('hospital.list');
        Route::match(['get', 'post'], 'create-hospital', [HospitalController::class, 'createHospital'])->name('hospital.create');
        Route::get('hospital-by-id/{id}', [HospitalController::class, 'hospitalById'])->name('hospital.by.id');
        Route::post('edit-hospital', [HospitalController::class, 'editHospital'])->name('hospital.edit');
        Route::get('delete-hospital/{id}', [HospitalController::class, 'deleteHospital'])->name('hospital.delete');
        Route::post('update-hospital-status', [HospitalController::class, 'updateHospitalStatus'])->name('hospital.status.update');
    });

    Route::group(['prefix' => 'portfolio'], function(){
        Route::get('list-of-doctors', [PortfolioController::class, 'listOfDoctors'])->name('portfolio.list');
        Route::match(['get', 'post'], 'create-doctors-portfolio', [PortfolioController::class, 'createDoctorsPortfolio'])->name('portfolio.create');
        Route::get('portfolio-by-id/{id}', [PortfolioController::class, 'portfolioById'])->name('portfolio.by.id');
        Route::post('edit-portfolio/{id}', [PortfolioController::class, 'editPortfolio'])->name('portfolio.edit');
        Route::get('delete-portfolio/{id}', [PortfolioController::class, 'deletePortfolio'])->name('portfolio.delete');
        Route::post('update-portfolio-status', [PortfolioController::class, 'updatePortfolioStatus'])->name('portfolio.status.update');
        Route::post('update-appointment-status', [PortfolioController::class, 'updateAppointmentStatus'])->name('appointment.status.update');
    });

    Route::group(['prefix' => 'link-hospital'], function(){
        Route::get('list-of-linked-hospitals', [PortfolioController::class, 'listOfLinkedHospitals'])->name('linked.hospital.list');
        Route::match(['get', 'post'], 'create', [PortfolioController::class, 'linkHospitalWithPortfolio'])->name('linked.hospital.create');
        Route::get('linked-hospital-by-id/{id}', [PortfolioController::class, 'getPortfolioLinkedHospitalsById'])->name('linked.hospital.by.id');
        Route::get('edit-linked-hospital/{id}', [PortfolioController::class, 'editLinkedHospital'])->name('linked.hospital.edit.get');
        Route::post('save-linked-edited-hospital', [PortfolioController::class, 'saveLinkedEditedHospital'])->name('linked.hospital.edit.save');
        Route::post('update-linked-hospital-status', [PortfolioController::class, 'updateLinkedHospitalStatus'])->name('linked.hospital.update.status');
    });

    Route::group(['prefix' => 'recent-events'], function(){
        Route::match(['get', 'post'], 'create-event', [PortfolioRecentEventsController::class, 'createEvent'])->name('recent.events.create');
        Route::get('list-of-events', [PortfolioRecentEventsController::class, 'listOfEvents'])->name('recent.events.get.list');
        Route::get('get-event-by-id/{id}', [PortfolioRecentEventsController::class, 'getEventById'])->name('recent.events.get.by.id');
        Route::post('edit-event', [PortfolioRecentEventsController::class, 'editEvent'])->name('recent.events.edit');
        Route::post('delete-event', [PortfolioRecentEventsController::class, 'deleteEvent'])->name('recent.events.delete');
    });

    Route::group(['prefix' => 'opd'], function(){
        Route::get('list-of-schedules', [OpdTimingController::class, 'listOfSchedules'])->name('opd.get.list.of.schedules');
        Route::match(['get', 'post'], 'set-schedule', [OpdTimingController::class, 'setOpdDateAndTime'])->name('opd.set.schedule');
        Route::get('schedule-by-id/{id}', [OpdTimingController::class, 'getOpdScheduleById'])->name('opd.get.schedule.by.id');
        Route::post('edit-schedule', [OpdTimingController::class, 'editSchedule'])->name('opd.edit.schedule');
        Route::post('update-schedule-status', [OpdTimingController::class, 'updateScheduleStatus'])->name('opd.update.schedule.status');
    });

    Route::group(['prefix' => 'lab-test-category'], function(){
        Route::match(['get', 'post'], 'create-category', [LabTestCategoryController::class, 'createLabTestCategory'])->name('lab.test.category.create');
        Route::get('list-of-categories', [LabTestCategoryController::class, 'listOfCategories'])->name('lab.test.category.list');
        Route::get('test-category-by-id/{id}', [LabTestCategoryController::class, 'getCategoryById'])->name('lab.test.category.get.by.id');
        Route::post('edit-test-category', [LabTestCategoryController::class, 'editLabTestCategory'])->name('lab.test.category.edit');
        Route::post('update-category-status', [LabTestCategoryController::class, 'updateCategoryStatus'])->name('lab.test.category.update.status');
        Route::get('delete-test-category/{id}', [LabTestCategoryController::class, 'deleteTestCategory'])->name('lab.test.category.delete');
    });

    Route::group(['prefix' => 'lab-test'], function(){
        Route::match(['get', 'post'], 'create-test', [LabTestController::class, 'createLabTest'])->name('lab.test.create');
        Route::get('list-of-test', [LabTestController::class, 'listOfTest'])->name('lab.test.get.list');
        Route::get('lab-test-by-id/{id}', [LabTestController::class, 'getLabTestById'])->name('lab.test.get.by.id');
        Route::post('edit-lab-test', [LabTestController::class, 'editLabTest'])->name('lab.test.edit');
        Route::post('update-lab-test-status', [LabTestController::class, 'updateLabTestStatus'])->name('lab.test.update.status');
        Route::get('delete-lab-test/{id}', [LabTestController::class, 'deleteLabTest'])->name('lab.test.delete');
    });

    Route::group(['prefix' => 'lab-test-package'], function(){
        Route::match(['get', 'post'], 'create-test-package', [LabTestPackageController::class, 'createTestPackage'])->name('lab.test.package.create');
        Route::get('lab-test-by-category/{id}', [LabTestPackageController::class, 'getLabTestByCategory'])->name('lab.package.test.get.by.category');
        Route::get('list-of-packages', [LabTestPackageController::class, 'getListOfPackages'])->name('lab.package.test.get.list');
        Route::get('delete-lab-test-package/{id}', [LabTestPackageController::class, 'deleteLabTestPackage'])->name('lab.package.test.delete');
        Route::get('lab-test-package-by-id/{id}', [LabTestPackageController::class, 'labTestPackageById'])->name('lab.package.test.get.by.id');
        Route::post('edit-lab-test-package', [LabTestPackageController::class, 'editLabTestPackage'])->name('lab.package.test.edit');
        Route::post('update-lab-test-package-status', [LabTestPackageController::class, 'updateLabTestPackageStatus'])->name('lab.package.test.update.status');
    });

    Route::group(['prefix' => 'academic-announcement'], function(){
        Route::get('list-of-announcements', [AcademicAnnouncementController::class, 'listOfAnnouncements'])->name('academic.announcements.get.list');
        Route::match(['get', 'post'],'create-announcements', [AcademicAnnouncementController::class, 'createAnnouncements'])->name('academic.announcements.create');
        Route::get('get-announcement-by-id/{id}', [AcademicAnnouncementController::class, 'getAnnouncementById'])->name('academic.announcement.get.by.id');
        Route::post('edit-announcement', [AcademicAnnouncementController::class, 'editAnnouncement'])->name('academic.announcement.edit');
        Route::get('delete-announcement/{id}', [AcademicAnnouncementController::class, 'deleteAnnouncement'])->name('academic.announcement.delete');
        Route::post('update-announcement-status', [AcademicAnnouncementController::class, 'updateAnnouncementStatus'])->name('academic.announcement.update.status');
    });

    Route::group(['prefix' => 'popup-manager'], function(){
        Route::get('list-of-popup', [PopupController::class, 'listofCreativePopup'])->name('popup.manager.list');
        Route::match(['get', 'post'],'create-popup', [PopupController::class, 'createCreativePopup'])->name('popup.manager.create');
        Route::get('get-popup-by-id/{id}', [PopupController::class, 'getCreativePopupById'])->name('popup.manager.creative.get.by.id');
        Route::post('edit-popup', [PopupController::class, 'editCreativePopup'])->name('popup.manager.edit');
        Route::get('delete-popup/{id}', [PopupController::class, 'deleteCreativePopup'])->name('popup.manager.delete');
        Route::post('update-popup-status', [PopupController::class, 'updateCreativePopupStatus'])->name('popup.manager.update.status');
    });

    Route::group(['prefix' => 'appointment'], function(){
        Route::group(['prefix' => 'offline'], function(){
            Route::get('list-of-appointments', [AppointmentController::class, 'listOfAppointments'])->name('appointment.offline.list');
        });
    });

    Route::group(['prefix' => 'lab-test-bookings'], function(){
        Route::get('list-of-bookings', [AppointmentController::class, 'listOfLabBookings'])->name('appointment.lab.test.bookings');
    });

    Route::get('view-pdf', function(){
        return view('pages.appointment-booking.generate_lab_test_payment_pdf');
    });

    Route::get('logout', function(){
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    })->name('logout');
});

