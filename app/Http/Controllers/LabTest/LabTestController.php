<?php

namespace App\Http\Controllers\LabTest;

use App\Models\LabTest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\LabTestCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
                'uploadCategoryIcon' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:1024',
                'test_amount' => 'required'
            ]);

            if($validator->fails()){
                return $this->error('Oops! Validation Error: '.$validator->errors()->first(), null, 400);
            }else{
                try{

                    $image_path = null;

                    if ($request->hasFile('uploadCategoryIcon')) {
                        $file = $request->file('uploadCategoryIcon');

                        if ($file->getClientOriginalExtension() === 'svg') {
                            // Read SVG contents
                            $svgContent = file_get_contents($file->getRealPath());

                            // Basic sanitization: remove scripts and inline event handlers
                            $safeSvg = preg_replace('/<script.*?<\/script>/is', '', $svgContent);
                            $safeSvg = preg_replace('/on\w+="[^"]*"/i', '', $safeSvg);

                            // Save to storage (public disk)
                            $filename = 'labTest/category/icon/' . uniqid() . '.svg';
                            Storage::disk('public')->put($filename, $safeSvg);

                            $image_path = $filename;
                        } else {
                            // For other images (png, jpg, jpeg, webp)
                            $image_path = $file->store('labTest/category/icon', 'public');
                        }
                    }


                    LabTest::create([
                        'lab_test_category_id' => $request->category_id,
                        'name' => $request->test_name,
                        'icon' => $image_path,
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
        try{
            $get_all_test = LabTest::with('labTestCategory')->where('status', 1)->latest()->get();
            return view('pages.lab-test.test.list_of_test')->with(['get_all_test' => $get_all_test]);
        }catch(\Exception $e){
            Log::error('Error at LabTestController@listOfTest : '.$e->getMessage().'. At line no: '.$e->getLine());
        }
    }

    public function getLabTestById($id){
        try{
            $lab_test_id = decrypt($id);
            $lab_test_categories = LabTestCategory::where('status', 1)->latest()->get();
            $lab_test_details = LabTest::with('labTestCategory')->where('id', $lab_test_id)->first();
            return view('pages.lab-test.test.edit_test')->with(['lab_test_details' => $lab_test_details, 'lab_test_categories' =>  $lab_test_categories]);
        }catch(\Exception $e){
            Log::error('Error at LabTestController@listOfTest : '.$e->getMessage().'. At line no: '.$e->getLine());
        }
    }

    public function editLabTest(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'test_name' => 'required',
            'uploadCategoryIcon' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:1024',
            'test_amount' => 'required'
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error: '.$validator->errors()->first(), null, 400);
        }else{
            try{

                $image_path = null;

                if ($request->hasFile('uploadCategoryIcon')) {
                    $file = $request->file('uploadCategoryIcon');

                    if ($file->getClientOriginalExtension() === 'svg') {
                        // Read SVG contents
                        $svgContent = file_get_contents($file->getRealPath());

                        // Basic sanitization: remove scripts and inline event handlers
                        $safeSvg = preg_replace('/<script.*?<\/script>/is', '', $svgContent);
                        $safeSvg = preg_replace('/on\w+="[^"]*"/i', '', $safeSvg);

                        // Save to storage (public disk)
                        $filename = 'labTest/category/icon/' . uniqid() . '.svg';
                        Storage::disk('public')->put($filename, $safeSvg);

                        $image_path = $filename;
                    } else {
                        // For other images (png, jpg, jpeg, webp)
                        $image_path = $file->store('labTest/category/icon', 'public');
                    }
                }

                $lab_test_id = decrypt($request->lab_test_id);

                LabTest::where('id', $lab_test_id)->update([
                    'lab_test_category_id' => $request->category_id,
                    'name' => $request->test_name,
                    'icon' => $image_path,
                    'description' => $request->test_desc,
                    'price' => $request->test_amount
                ]);
                return $this->success('Great! Lab test updated successfully', null, 201);
            }catch(\Exception $e){
                Log::error('Error at LabTestController@editLabTest : '.$e->getMessage().'. At line no: '.$e->getLine());
                return $this->error('Oops! Something went wrong. Please try later.', null, 500);
            }
        }
    }

    public function updateLabTestStatus(Request $request){
        try{
            $lab_test_id = decrypt($request->id);
            LabTest::where('id', $lab_test_id)->update([
                'status' => $request->status
            ]);
            return $this->success('Great! Lab test status updated successfully', null, 200);
        }catch(\Exception $e){
            Log::error('Error at LabTestController@updateLabTestStatus :'.$e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong', null, 500);
        }
    }

    public function deleteLabTest($id){
        try{
            $lab_test_id = decrypt($id);
            LabTest::where('id', $lab_test_id)->delete();
            Session::flash('success', 'Lab Test deleted successfully.');
            return redirect()->route('lab.test.get.list');
        }catch(\Exception $e){
            Log::error('Error at LabTestController@deleteLabTest :'.$e->getMessage().'. At line no: '.$e->getLine());
            Session::flash('exception', 'Something went wrong. Please try later.');
            return redirect()->route('lab.test.get.list');
        }
    }
}
