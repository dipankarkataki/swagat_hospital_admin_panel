<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PhoneNumberController extends Controller
{
    use ApiResponse;

    public function sendOTP(Request $request){
        $validator = Validator::make($request->all(), [
            'guest_phone_no' => 'required'
        ],[
            'guest_phone_no' => 'Phone number is required.'
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error : '.$validator->errors()->first(), null, 400);
        }else{
            try{
                $phone = $request->guest_phone_no;
                $key = 'otp_'.$phone;

                $otp = random_int(100000, 999999);
                Cache::put($key, $otp, now()->addMinutes(10));

                // $api_key = '4682186920A022';
                // $contacts = $request->guest_phone_no;
                // $senderID = 'SSSINH';
                // $template_id = '1xxx';
                // $msg = $otp . ' is the OTP to confirm your appointment booking details. Valid for next 10 min. Do not share this with anyone. Regards, Swagat Hopsital';
                // $sms_text = urlencode($msg);

                // //Submit to server

                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, "https://sms.hitechsms.com/app/smsapi/index.php");
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                // curl_setopt($ch, CURLOPT_POST, 1);
                // curl_setopt($ch, CURLOPT_POSTFIELDS,
                //     "key=$api_key&campaign=0&routeid=13&type=text&contacts=$contacts&senderid=$senderID&msg=$sms_text&template_id=$template_id"
                // );
                // $response = curl_exec($ch);
                // curl_close($ch);
                // echo $response;
                return $this->success('Great! OTP sent successfully.', $otp, 200);
            }catch(\Exception $e){
                Log::error('Error at Frontend/PhoneNumberController@sendOTP :-----: '.$e->getMessage().'. At line no :----:'.$e->getLine());
                return $this->error('Oops! Something went wrong. Please try later.', null, 500);
            }
        }
    }

    public function verifyOTP(Request $request){
        $validator = Validator::make($request->all(), [
            'guest_phone_no' => 'required',
            'otp' => 'required|digits:6'
        ],[
            'guest_phone_no' => 'Phone number is required.',
            'otp' => 'One Time Password is required.'
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error : '.$validator->errors()->first(), null, 400);
        }else{
            try{
                $phone = $request->guest_phone_no;
                $inputOtp = $request->otp;
                $cacheKey = 'otp_'.$phone;
                $cachedOtp = Cache::get($cacheKey);
                if ($cachedOtp && $inputOtp == $cachedOtp) {
                    Cache::forget($cacheKey);
                    return $this->success('Great! OTP verified successfully.', null, 200);
                }else{
                    return $this->error('Oops! Invalid or expired OTP', null, 400);
                }
            }catch(\Exception $e){
                Log::error('Error at Frontend/PhoneNumberController@sendOTP :-----: '.$e->getMessage().'. At line no :----:'.$e->getLine());
                return $this->error('Oops! Something went wrong. Please try later.', null, 500);
            }
        }
    }
}
