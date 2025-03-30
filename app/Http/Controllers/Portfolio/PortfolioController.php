<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function listOfDoctors(){
        return view('pages.portfolio.list_of_doctors');
    }

    public function createDoctorsPortfolio(Request $request){
        if($request->isMethod('get')){
            return view('pages.portfolio.create');
        }
    }
}
