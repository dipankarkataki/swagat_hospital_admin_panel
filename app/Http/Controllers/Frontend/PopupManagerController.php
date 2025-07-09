<?php

namespace App\Http\Controllers\Frontend;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\PopupManager;

class PopupManagerController extends Controller
{
    use ApiResponse;

    public function getCreative(){
        try{
            $get_creative = PopupManager::where('status', 1)->first();
            return $this->success('Great! Creative popup fetched successfully', $get_creative, 200);
        }catch(\Exception $e){
            Log::error('Error occurred at Frontend/PopupManagerController@getCreative : ' . $e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong', null, 500);
        }
    }
}
