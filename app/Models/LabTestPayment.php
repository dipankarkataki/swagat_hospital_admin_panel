<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabTestPayment extends Model
{
    protected $table = 'lab_test_payments';
    protected $fillable = [
        'name', 'price', 'type', 'cart_item_id', 'razorpay_payment_id', 'razorpay_order_id', 'amount',
        'payment_status', 'patient_name', 'patient_email', 'patient_phone'
    ];
}
