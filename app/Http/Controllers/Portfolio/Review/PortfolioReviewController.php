<?php

namespace App\Http\Controllers\Portfolio\Review;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\PortfolioReview;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PortfolioReviewController extends Controller
{
    use ApiResponse;

    public function addReviews(Request $request){
        $validator = Validator::make($request->all(), [
            'portfolioId' => 'required|integer',
            'fullName'  => 'required|string|max:30',
            'review' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        if($validator->fails()){
            return $this->error('Oops! Validation Error : '.$validator->errors()->first(), null, 400);
        }else{
            try{
                PortfolioReview::create([
                    'portfolio_id' => $request->portfolioId,
                    'name' => $request->fullName,
                    'review' => $request->review,
                    'rating' => $request->rating
                ]);
                return $this->success('Review created successfully', null, 200);
            }catch(\Exception $e){
                Log::error('Error occurred at Frontend/addReviews function: ' . $e->getMessage());
                return $this->error('Oops! Something went wrong. Failed to fetch doctors portfolio reviews.', null, 500);
            }
        }
    }
}
