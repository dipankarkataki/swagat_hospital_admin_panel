<?php

namespace App\Http\Controllers\Frontend;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\LabTestCategory;

class LabTestController extends Controller
{
    use ApiResponse;

    public function getLabTestCategories(){
        try{
            $all_categories = LabTestCategory::where('status', 1)->latest()->get();
            return $this->success('Great! Lab test categories fetched successfully', $all_categories, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/LabTestController@getLabTestCategories : ' . $e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong.', null, 500);
        }
    }

    public function listOfTestByCategory($id){
        try{
            $list_of_test = LabTest::where('lab_test_category_id', $id)->where('status', 1)->latest()->get();
            return $this->success('Great! Lab tests by category fetched successfully', $list_of_test, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/LabTestController@listOfTestByCategory : ' . $e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong.', null, 500);
        }
    }

    public function labTestDetailsById($id){
        try{
            $lab_test_details = LabTest::with('labTestCategory')->where('id', $id)->where('status', 1)->first();
            return $this->success('Great! Lab tests details fetched successfully', $lab_test_details, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/LabTestController@labTestDetailsById : ' . $e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong.', null, 500);
        }
    }
}
