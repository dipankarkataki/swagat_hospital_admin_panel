<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\AppointmentBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function listOfAppointments(){
        try{
            $list_of_appointments = AppointmentBooking::with(['portfolio.departments', 'hospital'])->latest()->get();
            return view('pages.appointment-booking.list_of_appointments')->with(['list_of_appointments' => $list_of_appointments]);
        }catch(\Exception $e){
            Log::error('Error at AppointmentController@listOfAppointments ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
        }
    }
}
