<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\PortfolioLinkedHospital;
use App\Traits\ApiResponse;

class PortfolioController extends Controller
{
    use ApiResponse;

    public function getByLinkedHospital($id){

        try{
            $get_portfolio_by_linked_hospital = PortfolioLinkedHospital::with('hospitals', 'portfolio', 'opdTimings')->where('hospital_id', $id)->latest()->get();

            return $this->success('Portfolio fetched successfully', $get_portfolio_by_linked_hospital, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/listOfDoctors function: ' . $e->getMessage());
            return $this->error('Oops! Something went wrong. Failed to fetch linked hospitals.', null, 500);
        }
    }

    public function getPortfolioById($id){
        try{
            $portfolio_details = Portfolio::with('hospitals', 'departments', 'opdTimings', 'recentEvents', 'reviews')->where('id', $id)->first();
            return $this->success('Portfolio fetched successfully', $portfolio_details, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/getPortfolioById function: ' . $e->getMessage());
            return $this->error('Oops! Something went wrong. Failed to fetch doctors portfolio.', null, 500);
        }
    }

    public function getAllLinkedHospitals(){
        try{
            $linked_portfolios = PortfolioLinkedHospital::where('status', 1)->latest()->get();
            return $this->success('Linked Portfolios fetched successfully', $linked_portfolios, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/getAllLinkedHospitals function: ' . $e->getMessage());
            return $this->error('Oops! Something went wrong. Failed to fetch all linked portfolios.', null, 500);
        }
    }
}
