<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\LabTestPackage;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(){
        try{
            $total_portfolio = Portfolio::where('status', 1)->count();
            $total_lab_tests = LabTest::where('status', 1)->count();
            $total_lab_tests_package = LabTestPackage::where('status', 1)->count();
            return view('pages.dashboard.dashboard')->with(['total_portfolio' => $total_portfolio, 'total_lab_tests' => $total_lab_tests, 'total_lab_tests_package' => $total_lab_tests_package]);
        }catch(\Exception $e){
            Log::error('Error in DashboardController@index: ' . $e->getMessage());
        }
    }
}
