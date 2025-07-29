<?php

namespace App\Http\Controllers\Appointment;

use App\Models\LabTest;
use Illuminate\Http\Request;
use App\Models\LabTestPackage;
use App\Models\LabTestPayment;
use App\Models\AppointmentBooking;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

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

    public function listOfLabBookings(){
        try{
            $allPayments = LabTestPayment::whereNotNull('razorpay_order_id')
                ->orderByDesc('created_at')
                ->get()
                ->groupBy('razorpay_order_id');

            $groupedInvoices = [];

            foreach ($allPayments as $razorpayId => $paymentsGroup) {
                $invoice = [];
                $subtotal = 0;
                $first = $paymentsGroup->first(); // to fetch patient info once

                $invoice['razorpay_order_id'] = $razorpayId;
                $invoice['patient_info'] = [
                    'name' => $first->patient_name,
                    'email' => $first->patient_email,
                    'phone' => $first->patient_phone,
                ];

                $invoice['items'] = [];

                foreach ($paymentsGroup as $payment) {
                    if ($payment->type === 'test') {
                        $test = LabTest::find($payment->cart_item_id);
                        if ($test) {
                            $invoice['items'][] = [
                                'description' => $test->name,
                                'quantity' => 1,
                                'unit_price' => $test->price,
                                'total' => $test->price,
                            ];
                            $subtotal += $test->price;
                        }
                    } elseif ($payment->type === 'package') {
                        $package = LabTestPackage::find($payment->cart_item_id);
                        if ($package) {
                            $testIds = json_decode($package->lab_test_id, true);
                            $tests = LabTest::whereIn('id', $testIds)->get();
                            foreach ($tests as $test) {
                                $invoice['items'][] = [
                                    'description' => $test->name . ' (Package: ' . $package->name . ')',
                                    'quantity' => 1,
                                    'unit_price' => $test->price,
                                    'total' => $test->price,
                                ];
                                $subtotal += $test->price;
                            }
                        }
                    }
                }

                $invoice['subtotal'] = $subtotal;
                $groupedInvoices[] = $invoice;
            }
            return view('pages.appointment-booking.list_of_lab_bookings')->with([
                'groupedInvoices' =>  $groupedInvoices
            ]);
        }catch(\Exception $e){
            Log::error('Error at AppointmentController@listOfLabBookings ::: --- ::: '.$e->getMessage().'. At Line no ::: --- ::: '.$e->getLine());
        }
    }
}
