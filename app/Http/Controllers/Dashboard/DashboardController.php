<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(){
        try{
            $total_portfolio = Portfolio::where('status', 1)->count();
            return view('pages.dashboard.dashboard')->with(['total_portfolio' => $total_portfolio]);

        }catch(\Exception $e){
            Log::error('Error in DashboardController@index: ' . $e->getMessage());
        }
    }
}
