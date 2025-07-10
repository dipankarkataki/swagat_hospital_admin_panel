<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AppointmentBooking;
use App\Models\LabTest;
use App\Models\LabTestPackage;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(){
        try{
            $today = Carbon::now();
            $total_portfolio = Portfolio::where('status', 1)->count();
            $total_lab_tests = LabTest::where('status', 1)->count();
            $total_lab_tests_package = LabTestPackage::where('status', 1)->count();
            $total_appointments = AppointmentBooking::withTrashed()->count();
            $get_latest_offline_appointments = AppointmentBooking::where('status', 1 )->latest()->get();
            return view('pages.dashboard.dashboard')->with([
                'total_portfolio' => $total_portfolio,
                'total_lab_tests' => $total_lab_tests,
                'total_lab_tests_package' => $total_lab_tests_package,
                'total_appointments' => $total_appointments,
                'latest_offline_appointments' => $get_latest_offline_appointments
            ]);
        }catch(\Exception $e){
            Log::error('Error in DashboardController@index: ' . $e->getMessage());
        }
    }
}
