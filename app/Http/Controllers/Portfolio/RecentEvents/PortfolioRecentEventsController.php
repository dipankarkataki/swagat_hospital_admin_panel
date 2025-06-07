<?php

namespace App\Http\Controllers\Portfolio\RecentEvents;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioRecentEvents;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PortfolioRecentEventsController extends Controller
{
    use ApiResponse;

    public function createEvent(Request $request){
        if($request->isMethod('get')){
            try{
                $portfolio_list = Portfolio::where('status', 1)->latest()->get();
                return view('pages.portfolio.recent-events.create_events')->with(['portfolio_list' => $portfolio_list]);
            }catch(\Exception $e){
                Log::error('Error occurred at createEvent function GET METHOD: ' . $e->getMessage());
                Session::flash('exception', 'Something went wrong while redirecting to Create Event page. Please try later.');
                return redirect()->route('portfolio.list');
            }
        }else{
            $validator = Validator::make($request->all(), [
                'portfolio_id' => 'required',
                'event_title' => 'required',
                'media_type' => 'required',
                'event_picture' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
                'event_video_thumbnail' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
                'event_video' => 'nullable|file|mimes:mp4,avi|max:3024',
            ]);

            if($validator->fails()){
                return $this->error('Oops! Validation Error : '.$validator->errors()->first(), null, 400);
            }else{
                try{
                    $thumbnail_path = '';
                    $media_path = '';

                    $hasPicture = $request->hasFile('event_picture');
                    $hasThumbnail = $request->hasFile('event_video_thumbnail');
                    $hasVideo = $request->hasFile('event_video');

                    if (!($hasPicture || ($hasThumbnail && $hasVideo))) {
                        return $this->error('Oops! You must either upload an image OR both a video and a thumbnail.', null, 400);
                    }

                    if($hasPicture){
                        $media_path = $request->file('event_picture')->store('recent_events/images');
                    }
                    if($hasThumbnail){
                        $thumbnail_path = $request->file('event_video_thumbnail')->store('recent_events/thumbnail/images');
                    }
                    if($hasVideo){
                        $media_path = $request->file('event_video')->store('recent_events/videos');
                    }

                    PortfolioRecentEvents::create([
                        'portfolio_id' => $request->portfolio_id,
                        'title' => $request->event_title,
                        'description' => $request->event_description,
                        'event_date' => $request->event_date,
                        'media_type' => $request->media_type,
                        'media_thumbnail_link' => $thumbnail_path,
                        'media_link' => $media_path
                    ]);
                    return $this->success('Great! Event created successfully', null, 201);
                }catch(\Exception $e){
                    Log::error('Error in PortfolioRecentEventsController@createEvent :'.$e->getMessage().'. At line no: '.$e->getLine());
                    return $this->error('Oops! Something went wrong. Please try later.', null, 500);
                }
            }
        }
    }

    public function listOfEvents(){
        try{
            $get_all_events = PortfolioRecentEvents::where('status', 1)->latest()->get();
            return view('pages.portfolio.recent-events.all_events')->with(['all_events' =>  $get_all_events]);
        }catch(\Exception $e){
            Log::error('Error at PortfolioRecentEventsController@listOfEvents while opening page: '.$e->getMessage());
            // Session::flash('exception', 'Oops! Something went wrong. Please try later.');
            // return redirect()->route('hospital.list');
        }
    }

    public function getEventById($id){
        $event_id = decrypt($id);
        try{
            $event_details = PortfolioRecentEvents::with('portfolio')->where('id', $event_id)->first();
            return view('pages.portfolio.recent-events.edit_event')->with(['event_details' => $event_details]);
        }catch(\Exception $e){
            Log::error('Error at PortfolioRecentEventsController@editEvent :'.$e->getMessage());
        }
    }

    public function editEvent(Request $request){
        $validator = Validator::make($request->all(), [
            'portfolio_id' => 'required',
            'event_title' => 'required',
            'media_type' => 'required',
            'event_picture' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'event_video_thumbnail' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'event_video' => 'nullable|file|mimes:mp4,avi|max:3024',
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error : '.$validator->errors()->first(), null, 400);
        }else{
            try{


                $event_id = decrypt($request->recentEventId);

                $event_details = PortfolioRecentEvents::where('id', $event_id)->first();

                $media_path = $event_details->media_link;
                $thumbnail_path = $event_details->media_thumbnail_link;

                $hasPicture = $request->hasFile('event_picture');
                $hasThumbnail = $request->hasFile('event_video_thumbnail');
                $hasVideo = $request->hasFile('event_video');

                if($hasPicture){
                    $media_path = $request->file('event_picture')->store('recent_events/images');
                    $thumbnail_path = null;
                }
                if($hasThumbnail){
                    $thumbnail_path = $request->file('event_video_thumbnail')->store('recent_events/thumbnail/images');
                }
                if($hasVideo){
                    $media_path = $request->file('event_video')->store('recent_events/videos');
                }

                PortfolioRecentEvents::where('id', $event_id)->update([
                    'title' => $request->event_title,
                    'description' => $request->event_description,
                    'event_date' => $request->event_date,
                    'media_thumbnail_link' => $thumbnail_path,
                    'media_link' => $media_path
                ]);
                return $this->success('Great! Event created successfully', null, 201);
            }catch(\Exception $e){
                Log::error('Error at PortfolioRecentEventsController@editEvent : '. $e->getMessage().'. At line no : '.$e->getLine());
                return $this->error('Oops! Something went wrong while editing event. Please try later.', null, 500);
            }
        }
    }

    public function deleteEvent(Request $request){
        try{
            $event_id = decrypt($request->event_id);
            PortfolioRecentEvents::where('id', $event_id)->delete();
            return $this->success('Great! Event deleted successfully', null, 200);
        }catch(\Exception $e){
            Log::error('Error at PortfolioRecentEventsController@deleteEvent : '. $e->getMessage().'. At line no : '.$e->getLine());
            return $this->error('Oops! Something went wrong while deleting event. Please try later.', null, 500);
        }
    }
}
