<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentBooking extends Model
{
    use SoftDeletes;

    protected $table = 'appointment_bookings';
    protected $fillable = [
        'booking_id', 'portfolio_id', 'hospital_id', 'full_name', 'email', 'phone',
        'zipcode', 'dob', 'gender', 'appointment_date', 'appointment_time', 'appointment_mode', 'booking_pdf_link', 'status'
    ];

    public function hospital(){
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }

    public function portfolio(){
        return $this->belongsTo(Portfolio::class, 'portfolio_id', 'id');
    }
}
