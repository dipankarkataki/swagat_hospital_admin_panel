<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function listOfDoctors(){
        return view('pages.portfolio.list_of_doctors');
    }

    public function createDoctorsPortfolio(Request $request){
        if($request->isMethod('get')){
            return view('pages.portfolio.create');
        }

        $validator = Validator::make($request->all(), [
            'uploadProfilePicture' => 'required|image|mimes:png,jpg|max:1024',
            'fullName' => 'required|string|min:3|max:255',
            'yearsOfExperience' => 'required|numeric',
            'department' => 'required|string',
            'languagesSpeak' => 'string',
            'briefDescription' => 'required|string|min:100',
            'expertise' => 'string',
            'membership' => 'string',
            'research' => 'string',
            'awards' => 'string',
            'availableDate' => 'date',
            'hospital' => 'string'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
    }
}
