<?php

namespace App\Http\Controllers\LabTest;

use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\LabTestCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LabTestController extends Controller
{
    use ApiResponse;

    public function createLabTest(Request $request){
        if($request->isMethod('get')){
            try{
                $get_test_categories = LabTestCategory::where('status', 1)->latest()->get();
                return view('pages.lab-test.test.create_test')->with(['lab_test_categories' => $get_test_categories]);
            }catch(\Exception $e){
                Log::error('Error at LabTestController@createLabTest -- Method Get ---'.$e->getMessage().'. At line no: '.$e->getLine());
            }
        }else{
            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
                'test_name' => 'required',
                'test_amount' => 'required'
            ]);

            if($validator->fails()){
                return $this->error('Oops! Validation Error: '.$validator->errors()->first(), null, 400);
            }else{
                try{
                    LabTest::create([
                        'lab_test_category_id' => $request->category_id,
                        'name' => $request->test_name,
                        'description' => $request->test_desc,
                        'price' => $request->test_amount
                    ]);
                    return $this->success('Great! Lab test created successfully', null, 201);
                }catch(\Exception $e){
                    Log::error('Error at LabTestController@createLabTest -- Method POST ---'.$e->getMessage().'. At line no: '.$e->getLine());
                    return $this->error('Oops! Something went wrong. Please try later.', null, 500);
                }
            }
        }
    }

    public function listOfTest(){

    }
}
