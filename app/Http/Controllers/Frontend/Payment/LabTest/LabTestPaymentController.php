<?php

namespace App\Http\Controllers\Frontend\Payment\LabTest;

use Razorpay\Api\Api;
use App\Models\LabTest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\LabTestPackage;
use App\Models\LabTestPayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Errors\SignatureVerificationError;

class LabTestPaymentController extends Controller
{
    use ApiResponse;

    public function createOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'totalAmount' => 'required|numeric'
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error :: '.$validator->errors()->first(), null, 400);
        }else{
            try{
                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

                $razorpayOrder = $api->order->create([
                    'receipt' => 'labtest_order_rcptid_' . time(),
                    'amount' => $request->totalAmount * 100, // in paise
                    'currency' => 'INR',
                ]);

                return $this->success('Great! Order id generated successfully', ['order_id' => $razorpayOrder['id'], 'razorpay_key' =>  config('services.razorpay.key')], 201);
            }catch(\Exception $e){
                Log::error('Error at Frontend/LabTestPaymentController@createOrder ::---:: '.$e->getMessage().'. At Line no ::--:: '.$e->getLine());
                return $this->error('Oops! Something went wrong while generating order Id for Lab Test', null, 500);
            }
        }
    }

    public function saveOrderDetails(Request $request){
        $validator = Validator::make($request->all(),[
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required',
            'razorpay_signature' => 'required',
            'amount' => 'required|numeric',
            'cart' => 'required|array',
            'payment_status' => 'required',
            'fullName' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error :: '.$validator->errors()->first(), null, 400);
        }else{
            try {
                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $api->utility->verifyPaymentSignature([
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                ]);
            } catch (SignatureVerificationError $e) {
                return $this->error('Oops! Payment signature verification failed', null, 400);
            }

            try{
                foreach ($request->cart as $item) {
                    LabTestPayment::create([
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'type' => $item['type'],
                        'cart_item_id' => $item['selected_item_id'],
                        'razorpay_payment_id' => $request->razorpay_payment_id,
                        'razorpay_order_id' => $request->razorpay_order_id,
                        'amount' => $request->amount,
                        'payment_status' => $request->payment_status,
                        'patient_name' => $request->fullName,
                        'patient_email' => $request->email,
                        'patient_phone' => $request->phone
                    ]);
                }
                return $this->success('Great! Order details saved successfully', null, 200);
            }catch(\Exception $e){
                Log::error('Error at Frontend/LabTestPaymentController@saveOrderDetails ::---:: '.$e->getMessage().'. At Line no ::--:: '.$e->getLine());
                return $this->error('Oops! Something went wrong while saving order details for Lab Test', null, 500);
            }
        }
    }

    // public function generateInvoice(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'order_id' => 'required'
    //     ]);

    //     if($validator->fails()){
    //         return $this->error('Oops! Validation Error :: '.$validator->errors()->first(), null, 400);
    //     }else{
    //         try{
    //             $get_payment_details = LabTestPayment::where('razorpay_order_id', $request->order_id)->get();

    //             $logo_path = 'assets/img/logo/swagat-logo-old.png';
    //             $invoice_data = [
    //                 'logo_path' => $logo_path
    //             ];

    //             foreach ($get_payment_details as $details) {
    //                 if ($details->type === 'test') {
    //                     $lab_test = LabTest::find($details->cart_item_id);

    //                     if ($lab_test) {
    //                         $invoice_data[] = [
    //                             'type' => 'test',
    //                             'test_name' => $lab_test->name,
    //                             'price' => $lab_test->price,
    //                             'razorpay_order_id' => $details->razorpay_order_id,
    //                             'created_at' => Carbon::parse($details->created_at)->format('d M, Y')
    //                         ];
    //                     }
    //                 } else if ($details->type === 'package') {
    //                     $package = LabTestPackage::find($details->cart_item_id);

    //                     if ($package) {
    //                         $tests = LabTest::whereIn('id', json_decode($package->lab_test_id))->get();

    //                         foreach ($tests as $lab_test) {
    //                             $invoice_data[] = [
    //                                 'type' => 'package',
    //                                 'test_name' => $lab_test->name,
    //                                 'price' => $lab_test->price,
    //                                 'razorpay_order_id' => $details->razorpay_order_id,
    //                                 'full_price' => $package->full_price,
    //                                 'discount' => $package->discount,
    //                                 'discounted_price' => $package->discounted_price,
    //                                 'created_at' => Carbon::parse($details->created_at)->format('d M, Y')
    //                             ];
    //                         }
    //                     }
    //                 }
    //             }

    //             $pdf = Pdf::loadView('pages.appointment-booking.generate_lab_test_payment_pdf', $invoice_data);
    //             $fileName = 'invoice_' . $request->order_id . '.pdf';
    //             $path = 'invoice/labTest/pdf/' . $fileName;
    //             Storage::disk('public')->put($path, $pdf->output());
    //             $publicUrl = asset('storage/' . $path);
    //             return $this->success('Great! Order details saved successfully', $publicUrl, 200);
    //         }catch(\Exception $e){
    //             Log::error('Error at Frontend/LabTestPaymentController@generateInvoice ::---:: '.$e->getMessage().'. At Line no ::--:: '.$e->getLine());
    //             return $this->error('Oops! Something went wrong while generating invoice for Lab Test', null, 500);
    //         }
    //     }
    // }

    public function generateInvoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation Error: ' . $validator->errors()->first(), null, 400);
        }

        try {
            $get_payment_details = LabTestPayment::where('razorpay_order_id', $request->order_id)->get();
            if($get_payment_details->isEmpty()){
                return $this->error('Oops! Failed to generate invoice.', null, 404);
            }

            $invoice_items = [];
            $subtotal = 0;

            $patient_info = [
                'patient_name' => $get_payment_details[0]['patient_name'],
                'patient_email' => $get_payment_details[0]['patient_email'],
                'patient_phone' => $get_payment_details[0]['patient_phone']
            ];

            foreach ($get_payment_details as $details) {

                if ($details->type === 'test') {
                    $lab_test = LabTest::find($details->cart_item_id);
                    if ($lab_test) {
                        $invoice_items[] = [
                            'description' => $lab_test->name,
                            'quantity' => 1,
                            'unit_price' => $lab_test->price,
                            'total' => $lab_test->price
                        ];
                        $subtotal += $lab_test->price;
                    }
                } elseif ($details->type === 'package') {
                    $package = LabTestPackage::find($details->cart_item_id);
                    if ($package) {
                        $tests = LabTest::whereIn('id', json_decode($package->lab_test_id))->get();
                        foreach ($tests as $lab_test) {
                            $invoice_items[] = [
                                'description' => $lab_test->name . ' (Part of Package: ' . $package->name . ')',
                                'quantity' => 1,
                                'unit_price' => $lab_test->price,
                                'total' => $lab_test->price
                            ];
                            $subtotal += $lab_test->price;
                        }
                    }
                }
            }

            $tax = $subtotal * 0;
            $total = $subtotal + $tax;

            $pdf = Pdf::loadView('pages.appointment-booking.generate_lab_test_payment_pdf', [
                'invoice_id' => $request->order_id,
                'issue_date' => now()->format('d M Y'),
                'issue_time' => now()->format('h:i A'),
                'due_date' => now()->format('d M Y'),
                'invoice_items' => $invoice_items,
                'subtotal' => number_format($subtotal, 2),
                'tax' => number_format($tax, 2),
                'total' => number_format($total, 2),
                'logo_path' => public_path('assets/img/logo/swagat-logo-old.png'),
                'paid_stamp_path' => public_path('assets/img/others/paid_stamp.png'),
                'patient_info' =>  $patient_info
            ]);

            $fileName = 'invoice_' . $request->order_id . '.pdf';
            $path = 'invoice/labTest/pdf/' . $fileName;
            Storage::disk('public')->put($path, $pdf->output());
            $publicUrl = asset('storage/' . $path);

            return $this->success('Invoice generated successfully', $publicUrl, 200);
        } catch (\Exception $e) {
            Log::error('Invoice generation error: ' . $e->getMessage());
            return $this->error('Failed to generate invoice.', null, 500);
        }
    }

}
