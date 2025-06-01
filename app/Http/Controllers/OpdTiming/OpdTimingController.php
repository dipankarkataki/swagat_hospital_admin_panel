<?php

namespace App\Http\Controllers\OpdTiming;

use App\Http\Controllers\Controller;
use App\Models\OpdTiming;
use App\Models\Portfolio;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OpdTimingController extends Controller
{
    use ApiResponse;

    public function setOpdDateAndTime(Request $request){

        if($request->isMethod('get')){
            $list_of_doctors = Portfolio::where('status', 1)->select('id', 'profile_pic', 'full_name', 'email')->get();
            return view('pages.opd-schedule.set_opd_schedule')->with(['portfolios' => $list_of_doctors]);
        }else{
            $validator = Validator::make($request->all(), [
                'portfolio_id' => 'required',
                'hospital_id' => 'required',
                'opd_date' => 'required|array',
                'opd_date.*' => 'required|date',
                'opd_start_time' => 'required',
                'opd_end_time' => 'required'
            ],[
                'portfolio_id' => 'Please select a doctor to get the linked hospitals.',
                'hospital_id' => 'Please select a hospital to set the OPD timings.',
                'opd_date.required' => 'Please set at least one OPD date.',
                'opd_date.*.required' => 'Each OPD date is required.',
                'opd_date.*.date' => 'Each OPD date must be a valid date.'
            ]);

            if($validator->fails()){
                return $this->error('Oops! Validation error : '. $validator->errors()->first(), null, 400);
            }else{
                try{
                    $is_opd_timing_exists = OpdTiming::where('portfolio_id', $request->portfolio_id)->where('hospital_id', $request->hospital_id)->exists();
                    if($is_opd_timing_exists){
                        return $this->error('Oops! OPD timings already exist. Please edit them to update the schedule.', null, 400);
                    }
                    OpdTiming::create([
                        'portfolio_id' => $request->portfolio_id,
                        'hospital_id' => $request->hospital_id,
                        'opd_date' => json_encode($request->opd_date),
                        'opd_start_time' => $request->opd_start_time,
                        'opd_end_time' => $request->opd_end_time
                    ]);
                    return $this->success('Great! OPD timings have been created successfully', null, 201);
                }catch(Exception $e){
                    Log::error('Error at OpdTimingController@setOpdDateAndTime :'.$e->getMessage());
                    return $this->error('Oops! Something went wrong. Please try later.', null, 500);
                }
            }
        }
    }
}
