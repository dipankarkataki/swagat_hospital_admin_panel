<?php

namespace App\Http\Controllers\Portfolio;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function listOfDoctors(){

        try{
            $get_portfolio = Portfolio::where('status', 1)->get();
            return view('pages.portfolio.list_of_doctors')->with(['portfolio' => $get_portfolio]);
        }catch(\Exception $e){
            Log::error('Error occurred at create portfolio function: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong. Please try later.'], 'exception');
        }
        
    }

    public function createDoctorsPortfolio(Request $request){
        if($request->isMethod('get')){
            return view('pages.portfolio.create');
        }else{
            
            $validator = Validator::make($request->all(), [
                'uploadProfilePicture' => 'required|image|mimes:png,jpg,jpeg|max:1024',
                'fullName' => 'required|string|min:3|max:255',
                'email' => 'required|email|unique:portfolios,email',
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
                return redirect()->route('portfolio.create')->withErrors($validator)->withInput();
            }

            try{

                $image_path = $request->file('uploadProfilePicture')->store('portfolio/images');
    
                Portfolio::create([
                    'profile_pic' => $image_path,
                    'full_name' => $request->fullName,
                    'email' => $request->email,
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
            return view('pages.portfolio.edit')->with(['portfolio' => $portfolio]);
        }catch(\Exception $e){
            Log::error('Error on portfolio by id function: '.$e->getMessage());
            Session::flash('exception', 'Oops! Something went wrong. Please try later.');
            return redirect()->route('portfolio.list');
        }
    }
}
