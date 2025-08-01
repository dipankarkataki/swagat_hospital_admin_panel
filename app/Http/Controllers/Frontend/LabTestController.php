<?php

namespace App\Http\Controllers\Frontend;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\LabTestCategory;
use App\Models\LabTestPackage;

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

    public function listOfSingleTestByCategory($category_id){
        try{
            $list_of_test = LabTest::with('labTestCategory')->where('lab_test_category_id', $category_id)->where('status', 1)->latest()->get();
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

    public function listOfPackageByCategory($category_id){
        try{
            $list_of_packages = LabTestPackage::where('lab_test_category_id', $category_id)->where('status', 1)->latest()->get();
            return $this->success('Great! Package by category fetched successfully', $list_of_packages, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/LabTestController@listOfPackageByCategory : ' . $e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong', null, 500);
        }
    }

    public function getLabPackageDetails($id){
        try{
            $package_details = LabTestPackage::where('id', $id)
                ->where('status', 1)
                ->first();

            if (is_null($package_details)) {
                return $this->error('Oops! Package details not found', null, 400);
            }

            $output_array = [
                'package_name' => $package_details->name,
                'full_price' => $package_details->full_price,
                'discounted_price' => $package_details->discounted_price,
                'discount' => $package_details->discount,
                'package_description' => $package_details->description,
                'test_details' => []
            ];

            $parsed_lab_test_ids = json_decode($package_details->lab_test_id);

            foreach ($parsed_lab_test_ids as $test_id) {
                $lab_test_details = LabTest::where('id', $test_id)
                    ->where('lab_test_category_id', $package_details->lab_test_category_id)
                    ->where('status', 1)
                    ->get();

                foreach ($lab_test_details as $test) {
                    $output_array['test_details'][] = [
                        'lab_test_name' => $test->name,
                        'description' => $test->description,
                        'price' => $test->price,
                    ];
                }
            }
            return $this->success('Great! Package details fetched successfully', $output_array, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/LabTestController@getLabPackageDetails : ' . $e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong', null, 500);
        }
    }
}
