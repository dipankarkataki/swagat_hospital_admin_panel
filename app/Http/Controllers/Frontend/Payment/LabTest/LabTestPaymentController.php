<?php

namespace App\Http\Controllers\Frontend\Payment\LabTest;

use App\Http\Controllers\Controller;
use App\Models\LabTestPayment;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
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
                        'type' => isset($item['discount']) ? 'package' : 'test',
                        'razorpay_payment_id' => $request->razorpay_payment_id,
                        'razorpay_order_id' => $request->razorpay_order_id,
                        'amount' => $request->amount,
                    ]);
                }
                return $this->success('Great! Order details saved successfully', null, 200);
            }catch(\Exception $e){
                Log::error('Error at Frontend/LabTestPaymentController@saveOrderDetails ::---:: '.$e->getMessage().'. At Line no ::--:: '.$e->getLine());
                return $this->error('Oops! Something went wrong while saving order details for Lab Test', null, 500);
            }
        }
    }

    public function generateInvoice(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' => $request->order_id
        ]);

        if($validator->fails()){
            return $this->error('Oops! Validation Error :: '.$validator->errors()->first(), null, 400);
        }else{
            try{
                $get_test_details = LabTestPayment::where('razorpay_order_id', $request->order_id)->get();
                // $logo_path = 'assets/img/logo/swagat-logo-old.png';
                // $pdf_data = [
                //     'invoice_id' => $get_booking_details->booking_id,
                //     'patient_full_name' => $get_booking_details->full_name,
                //     'patient_email' => $get_booking_details->email,
                //     'patient_phone' => $get_booking_details->phone,
                //     'dob' => $get_booking_details->dob,
                //     'gender' => $get_booking_details->gender,
                //     'zipcode' => $get_booking_details->zipcode,
                //     'created_at' => $get_booking_details->created_at,
                //     'logo_path' => $logo_path
                // ];
            }catch(\Exception $e){
                Log::error('Error at Frontend/LabTestPaymentController@generateInvoice ::---:: '.$e->getMessage().'. At Line no ::--:: '.$e->getLine());
                return $this->error('Oops! Something went wrong while generating invoice for Lab Test', null, 500);
            }
        }
    }
}
