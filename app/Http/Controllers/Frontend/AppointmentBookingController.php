<?php

namespace App\Http\Controllers\Frontend;

use App\Traits\ApiResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AppointmentBooking;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AppointmentBookingController extends Controller
{
    use ApiResponse;

    public function saveBookingDetails(Request $request){
        $validator = Validator::make($request->all(), [
            'portfolio_id' => 'required',
            'hospital_id' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'zipcode' => 'required|digits:6',
            'dob' => 'required',
            'gender' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'appointment_mode' => 'required'
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error: '.$validator->errors()->first(),
            null, 400);
        }else{
            try{
                DB::beginTransaction();

                    $latestBooking = AppointmentBooking::withTrashed()->latest('id')->first();
                    $nextNumber = $latestBooking ? $latestBooking->id + 1 : 1;

                    $formattedNumber = str_pad($nextNumber, 5, '0', STR_PAD_LEFT); // 00001, 00002, etc.
                    $bookingId = 'BK-SWGH-OFL-'.now()->format('ymd').'-'.$formattedNumber;

                    AppointmentBooking::create([
                        'booking_id' => $bookingId,
                        'portfolio_id' => $request->portfolio_id,
                        'hospital_id' => $request->hospital_id,
                        'full_name' => $request->full_name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'zipcode' => $request->zipcode,
                        'dob' => $request->dob,
                        'gender' => $request->gender,
                        'appointment_date' => $request->appointment_date,
                        'appointment_time' => $request->appointment_time,
                        'appointment_mode' => $request->appointment_mode
                    ]);
                    $get_booking_details = AppointmentBooking::with('hospital', 'portfolio')->where('booking_id', $bookingId)->first();
                    $pdf_data = [];
                    if($get_booking_details != null){

                        $get_department = Department::where('id', $get_booking_details->portfolio->department_id)->first();
                        $pdf_data = [
                            'hospital_name' => $get_booking_details->hospital->name,
                            'hospital_address' => $get_booking_details->hospital->address,
                            'hospital_phone' => $get_booking_details->hospital->phone,
                            'doctor_name' => $get_booking_details->portfolio->full_name,
                            'department' => $get_department->name,
                            'booking_id' => $get_booking_details->booking_id,
                            'opd_date' => $get_booking_details->appointment_date,
                            'opd_time' => $get_booking_details->appointment_time,
                            'opd_mode' => $get_booking_details->appointment_mode,
                            'patient_full_name' => $get_booking_details->full_name,
                            'patient_email' => $get_booking_details->email,
                            'patient_phone' => $get_booking_details->phone,
                            'dob' => $get_booking_details->dob,
                            'gender' => $get_booking_details->gender,
                            'zipcode' => $get_booking_details->zipcode,
                            'created_at' => $get_booking_details->created_at,
                        ];
                    }

                    $pdf = Pdf::loadView('pages.appointment-booking.generate_pdf', $pdf_data);

                    $fileName = 'booking_' . time() . '.pdf';
                    $path = 'booking/offline/pdf/' . $fileName;
                    Storage::disk('public')->put($path, $pdf->output());
                    $publicUrl = asset('storage/' . $path);

                    AppointmentBooking::with('hospital', 'portfolio')->where('id', $get_booking_details->id)->update([
                        'booking_pdf_link' => $publicUrl
                    ]);

                    $pdf_data['download_link'] = $publicUrl;

                    $this->bookingConfirmationMessage($request->phone, $get_booking_details->full_name, $get_department->name, $get_booking_details->appointment_date, $get_booking_details->appointment_time);

                DB::commit();

                return $this->success('Great! Appointment booked successfully', $pdf_data, 201);
            }catch(\Exception $e){
                DB::rollBack();
                Log::error('Error at AppointmentBookingController@saveBookingDetails :----:'.$e->getMessage().'. At line no :---:'.$e->getLine());
                return $this->error('Oops! Something went wrong. Please try later', null, 500);
            }
        }
    }

    private function bookingConfirmationMessage($guest_phone_no, $patient_name, $dept_name, $opd_date, $opd_time){
        $api_key = '4682186920A022';
        $contacts = $guest_phone_no;
        $senderID = 'SWAHPL';
        $template_id = '1207171758399997178';
        $msg = 'Dear '.$patient_name.', you have been registered in OPD at '.$dept_name.' at '.$opd_date.' '.$opd_time.'. Swagat Hospital';
        $sms_text = urlencode($msg);

        //Submit to server

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sms.hitechsms.com/app/smsapi/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "key=$api_key&campaign=0&routeid=13&type=text&contacts=$contacts&senderid=$senderID&msg=$sms_text&template_id=$template_id"
        );
        $response = curl_exec($ch);
        curl_close($ch);
    }
}
