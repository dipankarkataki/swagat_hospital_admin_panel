<?php

namespace App\Http\Controllers\OpdTiming;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
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

    public function listOfSchedules(){
        try{
            $get_opd_schedules = OpdTiming::with('hospital', 'portfolio')->latest()->get();
            return view('pages.opd-schedule.list_of_schedules')->with(['opd_schedules' => $get_opd_schedules]);
        }catch(\Exception $e){
            Log::error('Error at OpdTimingController@listOfSchedules :'.$e->getMessage());
            return back()->withErrors(['error' => 'Oops! Something went wrong while getting OPD schedules. Please try later.'], 'exception');
        }
    }

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

    public function getOpdScheduleById($id){
        try{
            $schedule_id = decrypt($id);
            $is_schedule_exists = OpdTiming::where('id', $schedule_id)->exists();
            if(!$is_schedule_exists){
                return back()->withErrors(['error' => 'Oops! No schedule exists.'], 'exception');
            }

            $get_schedule = OpdTiming::with('hospital', 'portfolio')->where('id', $schedule_id)->first();
            $get_hospital_list = Hospital::where('status', 1)->get();
            return view('pages.opd-schedule.edit_opd_schedule')->with(['opd_schedule' => $get_schedule, 'get_hospital_list' => $get_hospital_list]);
        }catch(\Exception $e){
            Log::error('Error at OpdTimingController@getOpdScheduleById :'.$e->getMessage());
            return back()->withErrors(['error' => 'Oops! Something went wrong while getting OPD schedules By ID. Please try later.'], 'exception');
        }
    }

    public function editSchedule(Request $request){

        $validator = Validator::make($request->all(), [
            'opd_timing_id' => 'required',
            'opd_date' => 'required|array',
            'opd_date.*' => 'required|date',
            'opd_start_time' => 'required',
            'opd_end_time' => 'required'
        ],[
            'opd_date.required' => 'Please set at least one OPD date.',
            'opd_date.*.required' => 'Each OPD date is required.',
            'opd_date.*.date' => 'Each OPD date must be a valid date.',
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation error : '. $validator->errors()->first(), null, 400);
        }else{
            try{
                $opd_id = decrypt($request->opd_timing_id);
                OpdTiming::where('id', $opd_id)->update([
                    'opd_date' => json_encode($request->opd_date),
                    'opd_start_time' => $request->opd_start_time,
                    'opd_end_time' => $request->opd_end_time
                ]);
                return $this->success('Great! OPD timings have been updated successfully', null, 200);
            }catch(\Exception $e){
                Log::error('Error at OpdTimingController@editSchedule :'.$e->getMessage());
                return $this->error('Oops! Something went wrong. Please try later.', null, 500);
            }
        }

    }
}
