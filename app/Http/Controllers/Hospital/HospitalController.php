<?php

namespace App\Http\Controllers\Hospital;

use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HospitalController extends Controller
{
    use ApiResponse;

    public function listOfHospitals(){
        $list_of_hospitals = Hospital::latest()->get();
        return view('pages.hospital.list_of_hospitals')->with(['list_of_hospitals' => $list_of_hospitals]);
    }

    public function createHospital(Request $request){
        if($request->isMethod('get')){
            return view('pages.hospital.create');
        }else{
            $validator = Validator::make($request->all(), [
                'hospital_name' => 'required|string|max:255',
                'hospital_address' => 'required|string|max:255',
            ]);

            if($validator->fails()){
                Log::error('Validation Error :'. $validator->errors());
                return $this->error('Validation Error', $validator->errors(), 422);
            }else{
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
    }

    public function hospitalById($id){
        try{
            $hospital_id = decrypt($id);
            $hospital = Hospital::where('id', $hospital_id)->first();
            return view('pages.hospital.edit')->with(['hospital' => $hospital]);
        }catch(\Exception $e){
            Log::error('Error on hospital by id function: '.$e->getMessage());
            Session::flash('exception', 'Oops! Something went wrong. Please try later.');
            return redirect()->route('hospital.list');
        }
    }

    public function editHospital(Request $request){
        $validator = Validator::make($request->all(), [
            'hospital_id' => 'required',
            'hospital_name' => 'required|string|max:255',
            'hospital_address' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            Log::error('Validation Error :'. $validator->errors());
            return $this->error('Validation Error', $validator->errors(), 422);
        }else{
            try{
                Hospital::where('id', $request->hospital_id)->update([
                    'name' => $request->hospital_name,
                    'address' => $request->hospital_address,
                ]);
                return $this->success('Hospital details edited successfully', null, 204);
            }catch(\Exception $e){
                Log::error('Error editing hospital details: '.$e->getMessage());
                return $this->error('Error editing hospital details', null, 500);
            }
        }
    }

    public function deleteHospital($id){
        try{
            $hospital_id = decrypt($id);
            $hospital = Hospital::find($hospital_id);
            if($hospital){
                $hospital->delete();
                Session::flash('success', 'Hospital deleted successfully.');
                return redirect()->route('hospital.list');
            }else{
                Session::flash('exception', 'Hospital not found.');
                return redirect()->route('hospital.list');
            }
        }catch(\Exception $e){
            Log::error('Error occurred at delete hospital function: ' . $e->getMessage());
            Session::flash('exception', 'Something went wrong. Please try later.');
            return redirect()->route('hospital.list');
        }
    }

    public function updateHospitalStatus(Request $request){
        try{
            $hospital_id = decrypt($request->id);
            Hospital::where('id', $hospital_id)->update([
               'status' => $request->status
            ]);
            $message = 'Status updated successfully. From '.($request->status == '1' ? 'blocked to active ' : 'active to blocked');
            return $this->success($message, null, 204);
        }catch(\Exception $e){
            Log::error('Error occurred at update status function: ' . $e->getMessage());
            return $this->error('Oops! Something went wrong. Please try later.', null, 400);
        }
    }
}
