<?php

namespace App\Http\Controllers\LabTest;

use App\Models\LabTest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\LabTestPackage;
use App\Models\LabTestCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\LabTestPackageCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
                'category_id'   => 'required|array',
                'package_name'  => 'required|string',
                'lab_test_id'   => 'required|array',
                'uploadCategoryIcon' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:1024',
                'package_desc'  => 'required|string',
                'package_amount'=> 'required|numeric',
            ]);

            if($validator->fails()){
                return $this->error('Oops! Validation Error: '.$validator->errors()->first(), null, 400);
            }else{
                try{
                    // Decrypt all category ids

                    $category_ids = [];
                    foreach ($request->category_id as $encId) {
                        try {
                            $category_ids[] = decrypt($encId);
                        } catch (\Exception $ex) {
                            Log::warning("Warning LabTestPackageController@createTestPackage Invalid encrypted category_id: ".$encId);
                        }
                    }

                    if (empty($category_ids)) {
                        return $this->error('Invalid category IDs received.', null, 400);
                    }

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

                    $package = LabTestPackage::create([
                        'name' => $request->package_name,
                        'icon' => $image_path,
                        'description' => $request->package_desc,
                        'lab_test_id' => json_encode($request->lab_test_id),
                        'full_price' => $request->package_amount,
                        'discount' => $request->package_discount,
                        'discounted_price' => $request->package_discounted_amount
                    ]);

                    $package->categories()->attach($category_ids);

                    return $this->success('Great! Lab test package created successfully', null, 201);
                }catch(\Exception $e){
                    Log::error('Error at LabTestPackageController@createTestPackage -- Method POST ---'.$e->getMessage().'. At line no: '.$e->getLine());
                    return $this->error('Oops! Something went wrong. Please try later', null, 500);
                }
            }
        }
    }

    public function getLabTestByCategories(Request $request){
        try{
            $encrypted_ids = $request->input('category_ids', []); // array of encrypted IDs
            if(empty($encrypted_ids)){
                return $this->error('No categories selected.', null, 400);
            }

            $category_ids = [];
            foreach ($encrypted_ids as $encId) {
                try {
                    $category_ids[] = decrypt($encId);
                } catch (\Exception $e) {
                    Log::warning("Warning at LabTestPackageController@getLabTestByCategory Invalid encrypted category id: " . $encId);
                }
            }

            if (empty($category_ids)) {
                return $this->error('Invalid category IDs.', null, 400);
            }

            $all_lab_tests = LabTest::whereIn('lab_test_category_id', $category_ids)->latest()->get();

            return $this->success('Great! Lab test by category fetched successfully.', $all_lab_tests, 200);
        }catch(\Exception $e){
            Log::error('Error at LabTestPackageController@getLabTestByCategory :'.$e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong. Please try later.', null, 500 );
        }
    }

    public function getListOfPackages(){
        try{
            $all_lab_test_packages = LabTestPackage::with('categories')->latest()->get();
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
            $package_categories = LabTestPackageCategory::where('lab_test_package_id', $get_package_id)->get();
            if($package_categories->isEmpty()){
                Log::error('Error at LabTestPackageController@labTestPackageById : No Package Id Found');
                Session::flash('exception', 'Oops! Something went wrong. Package id not found.');
                return redirect()->route('lab.package.test.get.list');
            }

            $category_ids = $package_categories->pluck('lab_test_category_id')->toArray();

            $package_details = LabTestPackage::where('id', $get_package_id)->first();
            $lab_test_category = LabTestCategory::where('status', 1)->get();
            $all_lab_test = LabTest::whereIn('lab_test_category_id',  $category_ids)->where('status', 1)->latest()->get();
            return view('pages.lab-test.package.edit_package')->with(['lab_test_category' => $lab_test_category, 'all_lab_test' => $all_lab_test, 'package_details' => $package_details, 'selected_categories' => $category_ids]);
        }catch(\Exception $e){
            Log::error('Error at LabTestPackageController@labTestPackageById :'.$e->getMessage().'. At line no: '.$e->getLine());
            Session::flash('exception', 'Unexpected error occurred. Please try again.');
            return redirect()->route('lab.package.test.get.list');
        }
    }

    public function editLabTestPackage(Request $request){
        $validator = Validator::make($request->all(), [
            'package_id'        => 'required',
            'category_id'       => 'required|array',
            'package_name'      => 'required|string',
            'lab_test_id'       => 'required|array',
            'uploadCategoryIcon' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:1024',
            'package_desc'      => 'required|string',
            'package_amount'    => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error: '.$validator->errors()->first(), null, 400);
        }else{
            try{
                $package_id = decrypt($request->package_id);

                // Decrypt category IDs
                $category_ids = [];
                foreach ($request->category_id as $encId) {
                    try {
                        $category_ids[] = decrypt($encId);
                    } catch (\Exception $ex) {
                        Log::warning("Warning LabTestPackageController@editLabTestPackage Invalid encrypted category_id: ".$encId);
                    }
                }

                if (empty($category_ids)) {
                    return $this->error('Invalid category IDs received.', null, 400);
                }

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

                $package = LabTestPackage::findOrFail($package_id);

                // Update package
                $package->update([
                    'name'              => $request->package_name,
                    'icon'              => $image_path ?? $package->icon,
                    'description'       => $request->package_desc,
                    'lab_test_id'       => json_encode($request->lab_test_id),
                    'full_price'        => $request->package_amount,
                    'discount'          => $request->package_discount,
                    'discounted_price'  => $request->package_discounted_amount
                ]);

                // Sync categories (detach old, attach new)
                $package->categories()->sync($category_ids);
                return $this->success('Great! Lab test package edited successfully', null, 200);
            }catch(\Exception $e){
                Log::error('Error at LabTestPackageController@editLabTestPackage -- Method POST ---'.$e->getMessage().'. At line no: '.$e->getLine());
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
