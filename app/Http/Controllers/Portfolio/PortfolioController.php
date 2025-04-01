<?php

namespace App\Http\Controllers\Portfolio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function listOfDoctors(){
        return view('pages.portfolio.list_of_doctors');
    }

    public function createDoctorsPortfolio(Request $request){
        if($request->isMethod('get')){
            return view('pages.portfolio.create');
        }else{
            
            $validator = Validator::make($request->all(), [
                'uploadProfilePicture' => 'required|image|mimes:png,jpg,jpeg|max:1024',
                'fullName' => 'required|string|min:3|max:255',
                'yearsOfExperience' => 'required|numeric',
                'department' => 'required|string',
                'languagesSpeak' => 'nullable|string',
                'briefDescription' => 'required|string|min:100',
                'expertise' => 'nullable|array',
                'membership' => 'nullable|array',
                'research' => 'nullable|array',
                'awards' => 'nullable|array',
                'availableDate' => 'nullable|array',
                'hospital' => 'required|string'
            ]);
    
            if($validator->fails()){
                Log::error('Validator Error'.$validator->errors()->first());
                return back()->withErrors($validator)->withInput();
            }
    
            try{

                $image_path = $request->file('uploadProfilePicture')->store('portfolio/images');
    
                Portfolio::create([
                    'profile_pic' => $image_path,
                    'full_name' => $request->fullName,
                    'experience' => $request->yearsOfExperience,
                    'department' => $request->department,
                    'languages_speak' => $request->languagesSpeak,
                    'brief_description' => $request->briefDescription,
                    'expertise' => json_encode($request->expertise),
                    'membership' => json_encode($request->membership),
                    'research' => json_encode($request->research),
                    'awards' => json_encode($request->awards),
                    'available_time_slot' => json_encode($request->availableDate),
                    'hospital' => $request->hospital
                ]);
    
                return back()->with(['success' => 'Portfolio created successfully']);
            }catch(\Exception $e){
                Log::error('Error occurred at create portfolio function: ' . $e->getMessage());
                return back()->withErrors(['error' => 'Something went wrong. Please try later.'], 'exception');
            }
        }

        
    }
}
