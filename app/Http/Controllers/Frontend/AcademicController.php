<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicAnnouncement;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AcademicController extends Controller
{
    use ApiResponse;

    public function listOfAnnouncements(){
        try{
            $announcements = AcademicAnnouncement::with('academic_media')->where('status', 1)->latest()->get();
            return $this->success('Great! Academic announcements fetched successfully', $announcements, 200);
        }catch(\Exception $e){
            Log::error('Error at AcademicController@listOfAnnouncements ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
            return $this->error('Oops! Something went wrong while fetching academic announcements', null, 500);
        }
    }
}
