<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\LabTest;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Models\LabTestPackage;
use App\Models\LabTestPayment;
use App\Models\AppointmentBooking;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        try{
            $today = Carbon::now();
            $total_portfolio = Portfolio::where('status', 1)->count();
            $total_lab_tests = LabTest::where('status', 1)->count();
            $total_lab_tests_package = LabTestPackage::where('status', 1)->count();
            $total_appointments = AppointmentBooking::withTrashed()->count();
            $get_latest_offline_appointments = AppointmentBooking::where('status', 1 )->limit(5)->latest()->get();
            $allPayments = LabTestPayment::whereNotNull('razorpay_order_id')
                ->orderByDesc('created_at')
                ->get()
                ->groupBy('razorpay_order_id')
                ->take(2);

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


            return view('pages.dashboard.dashboard')->with([
                'total_portfolio' => $total_portfolio,
                'total_lab_tests' => $total_lab_tests,
                'total_lab_tests_package' => $total_lab_tests_package,
                'total_appointments' => $total_appointments,
                'latest_offline_appointments' => $get_latest_offline_appointments,
                'groupedInvoices' =>  $groupedInvoices
            ]);
        }catch(\Exception $e){
            Log::error('Error in DashboardController@index: ' . $e->getMessage());
        }
    }
}
