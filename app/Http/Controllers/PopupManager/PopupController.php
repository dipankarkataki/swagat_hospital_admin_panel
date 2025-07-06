<?php

namespace App\Http\Controllers\PopupManager;

use App\Traits\ApiResponse;
use App\Models\PopupManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PopupController extends Controller
{
    use ApiResponse;

    public function listofCreativePopup(){
        try{
            $list_of_creatives = PopupManager::latest()->get();
            return view('pages.popup-manager.list_of_creative')->with(['list_of_creatives' => $list_of_creatives]);
        }catch(\Exception $e){
            Log::error('Error at PopupController@listofCreativePopup ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
        }
    }

    public function createCreativePopup(Request $request){
        if($request->isMethod('get')){
            return view('pages.popup-manager.create_popup');
        }else{
            $validator = Validator::make($request->all(), [
                'creative_image' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
                'creative_name' => 'required|string|max:255',
            ]);

            if($validator->fails()){
                Log::error('Validation Error :'. $validator->errors());
                return $this->error('Validation Error', $validator->errors(), 422);
            }else{
                try{
                    $image_path = '';
                    if($request->hasFile('creative_image')){
                        $image_path = $request->file('creative_image')->store('popupManage/creative/images');
                    }
                    PopupManager::create([
                        'image' =>  $image_path,
                        'name' => $request->creative_name,
                    ]);
                    return $this->success('Creative-Popup created successfully', null, 201);
                }catch(\Exception $e){
                    Log::error('Error at PopupController@createCreativePopup ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
                    return $this->error('Oops! Something went wrong while creating the creative-popup', null, 500);
                }
            }
        }
    }
}
