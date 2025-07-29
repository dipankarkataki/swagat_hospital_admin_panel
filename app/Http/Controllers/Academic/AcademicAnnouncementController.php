<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\AcademicAnnouncement;
use App\Models\AcademicMedia;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AcademicAnnouncementController extends Controller
{
    use ApiResponse;

    public function listOfAnnouncements(){
        try{
            $list_of_announcements = AcademicAnnouncement::latest()->get();
            return view('pages.academic.list_of_academic_announcements')->with(['list_of_announcements' => $list_of_announcements]);
        }catch(\Exception $e){
            Log::error('Error at AcademicAnnouncementController@listOfAnnouncements ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
        }
    }

    public function createAnnouncements(Request $request){
        if($request->isMethod('get')){
            return view('pages.academic.create_announcement');
        }else{
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'type' => 'required'
            ]);

            if($validator->fails()){
                return $this->error('Oops! Validation Error :: '.$validator->errors()->first(), null, 400);
            }else{
                try{
                    $create_announcement = AcademicAnnouncement::create([
                        'name' => $request->title,
                        'type' => $request->type,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                        'description' => $request->description
                    ]);
                    if($create_announcement && $request->hasFile('academic_images')){
                        $batch_media_insert = [];
                        foreach($request->file('academic_images') as $image){
                            $image_path = $image->store('academic/images');
                            $batch_media_insert[] = [
                                'academic_announcement_id' => $create_announcement->id,
                                'type' => 'image',
                                'photo' => $image_path,
                                'created_at' => now(),
                                'updated_at' => now()
                            ];
                        }
                        AcademicMedia::insert($batch_media_insert);
                    }
                    return $this->success('Great! Academic announcement created successfully', null, 201);
                }catch(\Exception $e){
                    Log::error('Error at AcademicAnnouncementController@createAnnouncements Post Method ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
                    return $this->error('Oops! Something went wrong', null, 500);
                }
            }
        }
    }

    public function getAnnouncementById($id){
        try{
            $announcement_id = decrypt($id);
            $get_announcement_details = AcademicAnnouncement::with('academic_media')->where('id', $announcement_id)->first();
            return view('pages.academic.edit_announcement')->with(['announcement_details' => $get_announcement_details]);
        }catch(\Exception $e){
           Log::error('Error at AcademicAnnouncementController@getAnnouncementById ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
        }
    }

    public function editAnnouncement(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'type' => 'required'
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error :: '.$validator->errors()->first(), null, 400);
        }else{
            try{
                $announcement_id = decrypt($request->announcement_id);
                AcademicAnnouncement::where('id', $announcement_id)->update([
                    'name' => $request->title,
                    'type' => $request->type,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'description' => $request->description
                ]);
                return $this->success('Great! Announcement edited successfully', null, 200);
            }catch(\Exception $e){
                Log::error('Error at AcademicAnnouncementController@editAnnouncement ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
                return $this->error('Oops! Something went wrong', null, 500);
            }
        }
    }

    public function deleteAnnouncement($id){
        try{
            $announcement_id = decrypt($id);
            AcademicAnnouncement::where('id', $announcement_id)->delete();
            Session::flash('success', 'Announcement deleted successfully.');
            return redirect()->route('academic.announcements.get.list');
        }catch(\Exception $e){
            Log::error('Error at  AcademicAnnouncementController@deleteAnnouncement :'.$e->getMessage().'. At line no: '.$e->getLine());
            Session::flash('exception', 'Something went wrong. Please try later.');
            return redirect()->route('academic.announcements.get.list');
        }
    }

    public function updateAnnouncementStatus(Request $request){
        try{
            $announcement_id = decrypt($request->id);
            AcademicAnnouncement::where('id', $announcement_id)->update([
                'status' => $request->status
            ]);
            return $this->success('Great! Announcement status updated successfully', null, 200);
        }catch(\Exception $e){
            Log::error('Error at AcademicAnnouncementController@updateAnnouncementStatus :'.$e->getMessage().'. At line no: '.$e->getLine());
            return $this->error('Oops! Something went wrong', null, 500);
        }
    }
}
