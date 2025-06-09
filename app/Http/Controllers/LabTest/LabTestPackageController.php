<?php

namespace App\Http\Controllers\LabTest;

use Illuminate\Http\Request;
use App\Models\LabTestCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class LabTestPackageController extends Controller
{
    public function createTestPackage(Request $request){
        if($request->isMethod('get')){
            try{
                $get_test_categories = LabTestCategory::where('status', 1)->latest()->get();
                return view('pages.lab-test.package.create_package')->with(['lab_test_categories' => $get_test_categories]);
            }catch(\Exception $e){
                Log::error('Error at LabTestPackageController@createTestPackage -- Method Get ---'.$e->getMessage().'. At line no: '.$e->getLine());
            }
        }else{

        }
    }
}
