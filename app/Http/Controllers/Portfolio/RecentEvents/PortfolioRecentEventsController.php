<?php

namespace App\Http\Controllers\Portfolio\RecentEvents;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Session;

class PortfolioRecentEventsController extends Controller
{
    public function createEvent(Request $request){
        if($request->isMethod('get')){
            try{
                $portfolio_list = Portfolio::where('status', 1)->latest()->get();
                return view('pages.portfolio.recent-events.create_events')->with(['portfolio_list' => $portfolio_list]);
            }catch(\Exception $e){
                Log::error('Error occurred at createEvent function GET METHOD: ' . $e->getMessage());
                Session::flash('exception', 'Something went wrong while redirecting to Create Event page. Please try later.');
                return redirect()->route('portfolio.list');
            }
        }else{

        }
    }
}
