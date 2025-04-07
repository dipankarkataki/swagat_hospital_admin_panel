<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use SoftDeletes;
    
    protected $table = 'portfolios';
    protected $fillable = [
        'profile_pic', 'full_name', 'email', 'experience', 'department', 'languages_speak', 'brief_description', 'expertise', 
        'membership', 'research', 'awards', 'available_time_slot', 'hospital_id', 'accepting_appointments', 'status'
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }
}
