<?php

namespace App\Http\Controllers\LabTest;

use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\LabTestCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LabTestCategoryController extends Controller
{
    use ApiResponse;

    public function createLabTestCategory(Request $request){
        if($request->isMethod('get')){
            try{
                return view('pages.lab-test.category.create_category');
            }catch(\Exception $e){
                Log::error('Error at LabTestCategoryController@createLabTestCategory -- Method: GET ---'.$e->getMessage().'. At line no : '.$e->getLine());
            }
        }else{
            $validator = Validator::make($request->all(), [
                'category_name' => 'required'
            ]);

            if($validator->fails()){
                return $this->error('Oops! Validation Error: '.$validator->errors()->first(), null, 400);
            }else{
                try{
                    LabTestCategory::create([
                        'name' => $request->category_name
                    ]);
                    return $this->success('Great! Lab test category added successfully', null, 201);
                }catch(\Exception $e){
                    Log::error('Error at LabTestCategoryController@createLabTestCategory -- Method: POST --- '.$e->getMessage().'. At line no: '.$e->getLine());
                    return $this->error('Oops! Something went wrong', null, 500);
                }
            }
        }

    }

    public function listOfCategories(){
        try{
            $get_categories = LabTestCategory::latest()->get();
            return view('pages.lab-test.category.list_of_categories')->with(['list_of_categories' => $get_categories]);
        }catch(\Exception $e){
            Log::error('Error at LabTestCategoryController@listOfCategories :'.$e->getMessage().'. At line no: '.$e->getLine());
        }
    }

    public function getCategoryById($id){
        try{
            $category_id = decrypt($id);
            $category_details = LabTestCategory::where('id', $category_id)->first();
            return view('pages.lab-test.category.edit_category')->with(['category_details' => $category_details]);
        }catch(\Exception $e){
            Log::error('Error at LabTestCategoryController@getCategoryById :'.$e->getMessage().'. At line no: '.$e->getLine());
        }
    }

    public function editLabTestCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'category_name' => 'required'
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error: '.$validator->errors()->first(), null, 400);
        }else{
            try{
                $category_id = decrypt($request->category_id);

                LabTestCategory::where('id', $category_id)->update([
                    'name' => $request->category_name
                ]);
                return $this->success('Great! Lab test category updated successfully', null, 200);
            }catch(\Exception $e){
                Log::error('Error at LabTestCategoryController@editLabTestCategory -- Method: POST --- '.$e->getMessage().'. At line no: '.$e->getLine());
                return $this->error('Oops! Something went wrong', null, 500);
            }
        }
    }

    public function updateCategoryStatus(Request $request){
        try{
            $category_id = decrypt($request->id);

            DB::beginTransaction();
                LabTestCategory::where('id', $category_id)->update([
                    'status' => $request->status
                ]);
                LabTest::where('lab_test_category_id', $category_id)->update([
                    'status' => $request->status
                ]);
            DB::commit();
            return $this->success('Great! Category status updated successfully', null, 200);
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Error at LabTestCategoryController@updateCategoryStatus :'.$e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong', null, 500);
        }
    }

    public function deleteTestCategory($id){
        try{
            $category_id = decrypt($id);
            DB::beginTransaction();
                LabTestCategory::where('id', $category_id)->delete();
                LabTest::where('lab_test_category_id', $category_id)->delete();
            DB::commit();
            Session::flash('success', 'Category deleted successfully.');
            return redirect()->route('lab.test.category.list');
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Error at LabTestCategoryController@deleteTestCategory :'.$e->getMessage().'. At line no: '.$e->getLine());
            Session::flash('exception', 'Something went wrong. Please try later.');
            return redirect()->route('lab.test.category.list');
        }
    }
}
