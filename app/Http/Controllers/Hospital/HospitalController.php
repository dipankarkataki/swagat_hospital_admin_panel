<?php

namespace App\Http\Controllers\Hospital;

use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HospitalController extends Controller
{
    use ApiResponse;

    public function listOfHospitals(){
        $list_of_hospitals = Hospital::where('status', 1)->latest()->get();
        return view('pages.hospital.list_of_hospitals')->with(['list_of_hospitals' => $list_of_hospitals]);
    }

    public function createHospital(Request $request){
        if($request->isMethod('get')){
            return view('pages.hospital.create');
        }

        $validator = Validator::make($request->all(), [
            'hospital_name' => 'required|string|max:255',
            'hospital_address' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            Log::error('Validation Error :'. $validator->errors());
            return $this->error('Validation Error', $validator->errors(), 422);
        }

        try{
            Hospital::create([
                'name' => $request->hospital_name,
                'address' => $request->hospital_address,
            ]);
            return $this->success('Hospital created successfully', null, 201);
        }catch(\Exception $e){
            Log::error('Error creating hospital: '.$e->getMessage());
            return $this->error('Error creating hospital', null, 500);
        }
    }
}
