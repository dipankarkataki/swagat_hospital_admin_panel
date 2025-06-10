<?php

namespace App\Http\Controllers\LabTest;

use App\Models\LabTest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\LabTestPackage;
use App\Models\LabTestCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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

    public function getListOfPackages(){
        try{
            $all_lab_test_packages = LabTestPackage::with('labTestCategory')->latest()->get();
            return view('pages.lab-test.package.list_of_packages')->with(['all_lab_test_packages' => $all_lab_test_packages]);
        }catch(\Exception $e){
            Log::error('Error at LabTestPackageController@getListOfPackages :'.$e->getMessage().'. At line no: '.$e->getLine());
        }
    }

    public function deleteLabTestPackage($id){
        try{
            $package_id = decrypt($id);
            LabTestPackage::where('id', $package_id)->delete();
            Session::flash('success', 'Package deleted successfully.');
            return redirect()->route('lab.package.test.get.list');
        }catch(\Exception $e){
            Log::error('Error at LabTestPackageController@deleteLabTestPackage :'.$e->getMessage().'. At line no: '.$e->getLine());
            Session::flash('exception', 'Something went wrong. Please try later.');
            return redirect()->route('lab.package.test.get.list');
        }
    }

    public function labTestPackageById($id){
        try{
            $get_package_id = decrypt($id);
            $package_details = LabTestPackage::with('labTestCategory')->where('id', $get_package_id)->first();
            $all_lab_test = LabTest::where('lab_test_category_id',  $package_details->lab_test_category_id)->where('status', 1)->latest()->get();
            return view('pages.lab-test.package.edit_package')->with(['all_lab_test' => $all_lab_test, 'package_details' => $package_details]);
        }catch(\Exception $e){
            Log::error('Error at LabTestPackageController@labTestPackageById :'.$e->getMessage().'. At line no: '.$e->getLine());
        }
    }

    public function editLabTestPackage(Request $request){
        $validator = Validator::make($request->all(), [
            'package_id' => 'required',
            'package_name' => 'required',
            'lab_test_id' => 'required',
            'package_desc' => 'required',
            'package_amount' => 'required',
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error: '.$validator->errors()->first(), null, 400);
        }else{
            try{
                $package_id = decrypt($request->package_id);
                LabTestPackage::where('id', $package_id)->update([
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

    public function updateLabTestPackageStatus(Request $request){
        try{
            $package_id = decrypt($request->id);
            LabTestPackage::where('id', $package_id)->update([
                'status' => $request->status
            ]);
            return $this->success('Great! Package status updated successfully', null, 200);
        }catch(\Exception $e){
            Log::error('Error at LabTestPackageController@updateLabTestPackageStatus :'.$e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong', null, 500);
        }
    }
}
