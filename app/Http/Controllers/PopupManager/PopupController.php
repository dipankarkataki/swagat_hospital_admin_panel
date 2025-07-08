<?php

namespace App\Http\Controllers\PopupManager;

use App\Traits\ApiResponse;
use App\Models\PopupManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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
                'creative_image' => 'required|image|mimes:png,jpg,jpeg|max:1024',
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

    public function getCreativePopupById($id){
        try{
            $creative_id = decrypt($id);
            $get_creative_details = PopupManager::where('id', $creative_id)->first();
            return view('pages.popup-manager.edit_popup')->with(['creative_details' => $get_creative_details]);
        }catch(\Exception $e){
           Log::error('Error at PopupController@getCreativeById ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
        }
    }

    public function editCreativePopup(Request $request){
        $validator = Validator::make($request->all(), [
            'creative_image' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'creative_name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error :: '.$validator->errors()->first(), null, 400);
        }else{
            try{
                $creative_id = decrypt($request->creative_id);
                $creative_details = PopupManager::where('id', $creative_id)->first();
                if($creative_details == null){
                    return $this->error('Oops! Creative doesnot exists', null, 404);
                }else{
                    $image_path = '';
                    if($request->hasFile('creative_image')){
                        $image_path = $request->file('creative_image')->store('popupManage/creative/images');
                    }else{
                        $image_path = $creative_details->image;
                    }

                    PopupManager::where('id', $creative_id)->update([
                        'image' =>  $image_path,
                        'name' => $request->creative_name,
                    ]);
                    return $this->success('Great! Creative edited successfully', null, 200);
                }
            }catch(\Exception $e){
                Log::error('Error at PopupController@editCreativePopup ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
                return $this->error('Oops! Something went wrong', null, 500);
            }
        }
    }

    public function deleteCreativePopup($id){
        try{
            $creative_id = decrypt($id);
            $creative = PopupManager::find($creative_id);
            if($creative){
                $creative->delete();
                Session::flash('success', 'Creative deleted successfully.');
                return redirect()->route('popup.manager.list');
            }else{
                Session::flash('exception', 'Creative not found.');
                return redirect()->route('popup.manager.list');
            }
        }catch(\Exception $e){
            Log::error('Error occurred at delete creative function: ' . $e->getMessage());
            Session::flash('exception', 'Something went wrong. Please try later.');
            return redirect()->route('popup.manager.list');
        }
    }

    public function updateCreativePopupStatus(Request $request){
        try{
            if($request->status == 1){
                $check_active_popup = PopupManager::where('status', 1)->exists();
                if($check_active_popup){
                    return $this->error('Oops! A creative is already active. Please disable the active creative before activating a new one.', null, 400);
                }
            }


            $creative_id = decrypt($request->id);
            PopupManager::where('id', $creative_id)->update([
                'status' => $request->status
            ]);
            return $this->success('Great! Creative status updated successfully', null, 200);
        }catch(\Exception $e){
            Log::error('Error at PopupController@updateCreativePopupStatus :'.$e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong', null, 500);
        }
    }
}
