<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HospitalController extends Controller
{
    use ApiResponse;

    public function getListOfHospitals(){
        try{
            $get_hospital_list = Hospital::where('status', 1)->latest()->get();
            return $this->success('Great! Hospitals fetched successfully', $get_hospital_list, 200);
        }catch(\Exception $e){
            Log::error('Error at Frontend/HospitalController@getListOfHospitals :----: '.$e->getMessage().'. At line no :---:'.$e->getLine());
            return $this->error('Oops! Something went wrong. Please try later', null, 500);
        }
    }
}
