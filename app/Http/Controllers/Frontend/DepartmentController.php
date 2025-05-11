<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Department;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    use ApiResponse;
    
    public function listOfDepartments(){
        try{
            $get_departments = Department::latest()->get();
            return $this->success('Departments fetched successfully', $get_departments, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/listOfDepartments function: ' . $e->getMessage());
            return $this->error('Oops! Something went wrong. Failed to fetch departments.', null, 500);
        }
    }
}
