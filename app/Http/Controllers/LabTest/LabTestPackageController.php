<?php

namespace App\Http\Controllers\LabTest;

use Illuminate\Http\Request;
use App\Models\LabTestCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\LabTestPackage;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Validator;

class LabTestPackageController extends Controller
{
    use ApiResponse;

    public function createTestPackage(Request $request){
        if($request->isMethod('get')){
            try{
                $get_test_categories = LabTestCategory::where('status', 1)->latest()->get();
                return view('pages.lab-test.package.create_package')->with(['lab_test_categories' => $get_test_categories]);
            }catch(\Exception $e){
                Log::error('Error at LabTestPackageController@createTestPackage -- Method Get ---'.$e->getMessage().'. At line no: '.$e->getLine());
            }
        }else{
            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
                'package_name' => 'required',
                'lab_test_id' => 'required',
                'package_desc' => 'required',
                'package_amount' => 'required',
            ]);

            if($validator->fails()){
                return $this->error('Oops! Validation Error: '.$validator->errors()->first(), null, 400);
            }else{
                try{
                    $category_id = decrypt($request->category_id);
                    LabTestPackage::create([
                        'lab_test_category_id' => $category_id,
                        'name' => $request->package_name,
                        'description' => $request->package_desc,
                        'lab_test_id' => json_encode($request->lab_test_id),
                        'full_price' => $request->package_amount,
                        'discount' => $request->package_discount,
                        'discounted_price' => $request->package_discounted_amount
                    ]);
                    return $this->success('Great! Lab test package created successfully', null, 201);
                }catch(\Exception $e){
                    Log::error('Error at LabTestPackageController@createTestPackage -- Method POST ---'.$e->getMessage().'. At line no: '.$e->getLine());
                    return $this->error('Oops! Something went wrong. Please try later', null, 500);
                }
            }
        }
    }

    public function getLabTestByCategory($id){
        try{
            $category_id = decrypt($id);
            $all_lab_tests = LabTest::where('lab_test_category_id', $category_id)->latest()->get();
            return $this->success('Great! Lab test by category fetched successfully.', $all_lab_tests, 200);
        }catch(\Exception $e){
            Log::error('Error at LabTestPackageController@getLabTestByCategory :'.$e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong. Please try later.', null, 500 );
        }
    }
}
