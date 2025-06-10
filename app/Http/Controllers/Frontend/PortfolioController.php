<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class PortfolioController extends Controller
{
    use ApiResponse;

    public function listOfDoctors(){

        try{
            $get_portfolio = Portfolio::with('portfolioLinkedHospital', 'departments')->latest()->get();
            return $this->success('Portfolio fetched successfully', $get_portfolio, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/listOfDoctors function: ' . $e->getMessage());
            return $this->error('Oops! Something went wrong. Failed to fetch doctors portfolio.', null, 500);
        }

    }
}
