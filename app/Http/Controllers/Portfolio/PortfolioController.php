<?php

namespace App\Http\Controllers\Portfolio;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Hospital;
use App\Models\OpdTiming;
use App\Models\PortfolioLinkedHospital;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    use ApiResponse;
    public function listOfDoctors(){

        try{
            $get_portfolio = Portfolio::with('portfolioLinkedHospital', 'departments')->latest()->get();
            return view('pages.portfolio.list_of_doctors')->with(['portfolio' => $get_portfolio]);
        }catch(\Exception $e){
            Log::error('Error occurred at create portfolio function: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong. Please try later.'], 'exception');
        }

    }

    public function createDoctorsPortfolio(Request $request){
        if($request->isMethod('get')){
            $list_of_departments = Department::where('status', 1)->get();
            return view('pages.portfolio.create')->with(['list_of_departments' =>  $list_of_departments]);
        }else{
            $validator = Validator::make($request->all(), [
                'uploadProfilePicture' => 'required|image|mimes:png,jpg,jpeg|max:1024',
                'fullName' => 'required|string|min:3|max:255',
                'email' => 'required|email|unique:portfolios,email',
                'qualification' => 'required|string|min:3',
                'yearsOfExperience' => 'required|numeric',
                'department_id' => 'required|numeric',
                'languagesSpeak' => 'nullable|string',
                'briefDescription' => 'required|string|min:100',
                'expertise' => 'nullable|array',
                'membership' => 'nullable|array',
                'research' => 'nullable|array',
                'awards' => 'nullable|array',
                // 'opdDate' => 'nullable|array',
                // 'opdStartTime' => 'nullable',
                // 'opdEndTime' => 'nullable',
                // 'hospital_id' => 'required|array'
            ]
            // ,[
            //     'hospital_id.required' => 'Please select a hospital.',
            // ]
            );

            if($validator->fails()){
                Log::error('Validator Error'.$validator->errors()->first());
                return redirect()->route('portfolio.create')->withErrors($validator)->withInput();
            }

            try{
                $image_path = $request->file('uploadProfilePicture')->store('portfolio/images');

                Portfolio::create([
                    'profile_pic' => $image_path,
                    'full_name' => $request->fullName,
                    'email' => $request->email,
                    'qualification' => $request->qualification,
                    'experience' => $request->yearsOfExperience,
                    'department_id' => $request->department_id,
                    'languages_speak' => $request->languagesSpeak,
                    'brief_description' => $request->briefDescription,
                    'expertise' => json_encode($request->expertise),
                    'membership' => json_encode($request->membership),
                    'research' => json_encode($request->research),
                    'awards' => json_encode($request->awards),
                    // 'opd_date' => json_encode($request->opdDate),
                    // 'opd_start_time' => $request->opdStartTime,
                    // 'opd_end_time' => $request->opdEndTime,
                    // 'available_time_slot' => json_encode($request->availableDate),
                    // 'hospital_id' => $request->hospital_id,
                    // 'accepting_appointments' => $request->availableDate[0] ? 1 : 0,
                ]);
                Session::flash('success', 'Portfolio created successfully.');
                return redirect()->route('portfolio.create');
            }catch(\Exception $e){
                Log::error('Error occurred at create portfolio function: ' . $e->getMessage());
                Session::flash('exception', 'Something went wrong. Please try later.');
                return redirect()->route('portfolio.create')->withInput();
            }
        }
    }

    public function portfolioById($id){
        try{
            $portfolio_id = decrypt($id);
            $portfolio = Portfolio::find($portfolio_id);
            $list_of_hospitals = Hospital::where('status', 1)->get();
            $list_of_departments = Department::where('status', 1)->get();
            return view('pages.portfolio.edit')->with(['portfolio' => $portfolio, 'list_of_hospitals' => $list_of_hospitals, 'list_of_departments' => $list_of_departments]);
        }catch(\Exception $e){
            Log::error('Error on portfolio by id function: '.$e->getMessage());
            Session::flash('exception', 'Oops! Something went wrong. Please try later.');
            return redirect()->route('portfolio.list');
        }
    }

    public function editPortfolio(Request $request, $id){
        $portfolio_id = decrypt($id);

        $validator = Validator::make($request->all(), [
            'uploadProfilePicture' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'fullName' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:portfolios,email,'.$portfolio_id,
            'qualification' => 'required|string',
            'yearsOfExperience' => 'required|numeric',
            'department_id' => 'required|numeric',
            'languagesSpeak' => 'nullable|string',
            'briefDescription' => 'required|string|min:100',
            'expertise' => 'nullable|array',
            'membership' => 'nullable|array',
            'research' => 'nullable|array',
            'awards' => 'nullable|array',
            // 'availableDate' => 'nullable|array',
            // 'opdDate' => 'nullable|array',
            // 'opdStartTime' => 'nullable',
            // 'opdEndTime' => 'nullable',
            // 'hospital_id' => 'required|numeric'
        ],[
            // 'hospital_id.required' => 'Please select a hospital.',
        ]);

        if($validator->fails()){
            Log::error('Validator Error'.$validator->errors()->first());
            return redirect()->route('portfolio.by.id', ['id' => encrypt($portfolio_id)])->withErrors($validator)->withInput();
        }

        try{

            $portfolio = Portfolio::find($portfolio_id);

            if($request->hasFile('uploadProfilePicture')){
                $image_path = $request->file('uploadProfilePicture')->store('portfolio/images');
                $portfolio->profile_pic = $image_path;
            }

            $portfolio->full_name = $request->fullName;
            $portfolio->email = $request->email;
            $portfolio->qualification = $request->qualification;
            $portfolio->experience = $request->yearsOfExperience;
            $portfolio->department_id = $request->department_id;
            $portfolio->languages_speak = $request->languagesSpeak;
            $portfolio->brief_description = $request->briefDescription;
            $portfolio->expertise = json_encode($request->expertise);
            $portfolio->membership = json_encode($request->membership);
            $portfolio->research = json_encode($request->research);
            $portfolio->awards = json_encode($request->awards);
            // $portfolio->available_time_slot = json_encode($request->availableDate);
            // $portfolio->opd_date = json_encode($request->opdDate);
            // $portfolio->opd_start_time = $request->opdStartTime;
            // $portfolio->opd_end_time = $request->opdEndTime;
            // $portfolio->hospital_id = $request->hospital_id;

            if ($portfolio->save()) {
                Session::flash('success', 'Portfolio updated successfully.');
                return redirect()->route('portfolio.by.id', ['id' => encrypt($portfolio_id)]);
            } else {
                Session::flash('exception', 'Something went wrong. Please try later.');
                return redirect()->route('portfolio.by.id', ['id' => encrypt($portfolio_id)])->withInput();
            }
        }catch(\Exception $e){
            Log::error('Error occurred at edit portfolio function: ' . $e->getMessage());
            Session::flash('exception', 'Something went wrong. Please try later.');
            return redirect()->route('portfolio.by.id', ['id' => encrypt($portfolio_id)])->withInput();
        }
    }

    public function deletePortfolio($id){
        try{
            $portfolio_id = decrypt($id);
            $portfolio = Portfolio::find($portfolio_id);
            if($portfolio){
                $portfolio->delete();
                Session::flash('success', 'Portfolio deleted successfully.');
                return redirect()->route('portfolio.list');
            }else{
                Session::flash('exception', 'Portfolio not found.');
                return redirect()->route('portfolio.list');
            }
        }catch(\Exception $e){
            Log::error('Error occurred at delete portfolio function: ' . $e->getMessage());
            Session::flash('exception', 'Something went wrong. Please try later.');
            return redirect()->route('portfolio.list');
        }
    }

    public function updatePortfolioStatus(Request $request){
        try{
            $portfolio_id = decrypt($request->id);
            $portfolio = Portfolio::find($portfolio_id);
            if($portfolio){
                $portfolio->status = $request->status;
                $portfolio->save();
                $message = 'Status updated successfully. From '.($request->status == '1' ? 'blocked to active ' : 'active to blocked');
                return $this->success($message, null, 204);
            }else{
                return $this->error('Failed to update status.', null, 400);
            }
        }catch(\Exception $e){
            Log::error('Error occurred at update status function: ' . $e->getMessage());
            return $this->error('Oops! Something went wrong. Please try later.', null, 400);
        }
    }

    public function updateAppointmentStatus(Request $request){
        try{
            $portfolio_id = decrypt($request->portfolio_id);
            $portfolio = Portfolio::find($portfolio_id);
            if($portfolio){
                $portfolio->accepting_appointments = $request->status;
                $portfolio->save();;
                return $this->success('Appointment status updated successfully.', null, 204);
            }else{
                return $this->error('Failed to update the appointment status.', null, 400);
            }
        }catch(\Exception $e){
            Log::error('Error occurred at update appointment status function: ' . $e->getMessage());
            return $this->error('Oops! Something went wrong. Please try later.', null, 500);
        }
    }

    public function listOfLinkedHospitals(){
        try{
            $get_linked_hospitals = PortfolioLinkedHospital::with('hospitals', 'portfolio')->latest()->get();
            return view('pages.portfolio.link-hospital.list_of_linked_hospitals')->with(['linked_hospitals' => $get_linked_hospitals]);
        }catch(\Exception $e){
            Log::error('Error occurred at get list of linked hospitals function: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong. Please try later.'], 'exception');
        }
    }

    public function getPortfolioLinkedHospitalsById($id){
        try{
            $get_hospitals = PortfolioLinkedHospital::with('hospitals')->where('portfolio_id', $id)->get();
            return $this->success('Great! Linked hospitals fetched successfully',  $get_hospitals, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at PortfolioController@getPortfolioLinkedHospitalsById: ' . $e->getMessage());
            return $this->error('Oops! Something went wrong.', null, 500);
        }
    }

    public function linkHospitalWithPortfolio(Request $request){

        if($request->isMethod('get')){
            $list_of_hospitals = Hospital::where('status', 1)->get();
            $list_of_doctors = Portfolio::where('status', 1)->select('id', 'profile_pic', 'full_name', 'email')->get();
            return view('pages.portfolio.link-hospital.link_with_portfolio')->with(['list_of_hospitals' => $list_of_hospitals, 'portfolios' => $list_of_doctors]);
        }else{
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required|numeric',
                'hospital_id' => 'required|numeric'
            ]);

            if($validator->fails()){
                return $this->error('Oops! Validation error : '.$validator->errors()->first(), null, 400);
            }

            try{

                $check_if_hospital_already_linked = PortfolioLinkedHospital::where('portfolio_id', $request->doctor_id)->where('hospital_id', $request->hospital_id)->exists();
                if($check_if_hospital_already_linked){
                    return $this->error('Oops! Hospital is already linked. Please select a different hospital.', null, 400);
                }
                PortfolioLinkedHospital::create([
                    'portfolio_id' => $request->doctor_id,
                    'hospital_id' => $request->hospital_id
                ]);
                return $this->success('Great! Hospital linked successfully', null, 201);
            }catch(\Exception $e){
                Log::error('Error occurred at link hospital with portfolio function: ' . $e->getMessage());
                return $this->error('Oops! Something went wrong. Please try later.', null, 500);
            }
        }
    }

    public function editLinkedHospital($id){
        try{
            $linked_hosp_id = decrypt($id);

            $all_hospitals = Hospital::where('status', 1)->get();
            $get_linked_hospital = PortfolioLinkedHospital::with('hospitals', 'portfolio')->where('id', $linked_hosp_id)->first();
            return view('pages.portfolio.link-hospital.edit_linked_hospital')->with(['linked_hospital' => $get_linked_hospital, 'all_hospitals' => $all_hospitals]);
        }catch(\Exception $e){
            Log::error('Error occurred at PortfolioController@editLinkedHospital: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong. Please try later.'], 'exception');
        }
    }

    public function saveLinkedEditedHospital(Request $request){
        try{
            $linked_hosp_id = decrypt($request->linked_hosp_id);
            $check_if_hospital_already_linked =  PortfolioLinkedHospital::where('portfolio_id', $request->portfolio_id)->where('hospital_id', $request->new_hospital_id)->exists();
            if($check_if_hospital_already_linked ){
                return $this->error('Oops! Hospital is already linked', null, 400);
            }else{
                DB::beginTransaction();
                PortfolioLinkedHospital::where('id', $linked_hosp_id)->update([
                    'hospital_id' => $request->new_hospital_id
                ]);
                OpdTiming::where('portfolio_id', $request->portfolio_id)->where('hospital_id', $request->old_hosp_id)->update([
                    'hospital_id' => $request->new_hospital_id
                ]);
                DB::commit();
                return $this->success('Great! Portfolio updated with new hospital successfully.', null, 200);
            }
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Error occurred at PortfolioController@saveLinkedEditedHospital: ' . $e->getMessage());
            return $this->error('Oops! Something went wrong', null, 500);
        }
    }
}
