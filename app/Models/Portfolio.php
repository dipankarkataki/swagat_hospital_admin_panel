<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use SoftDeletes;
    
    protected $table = 'portfolios';
    protected $fillable = [
        'profile_pic', 'full_name', 'experience', 'department', 'languages_speak', 'brief_description', 'expertise', 
        'membership', 'research', 'awards', 'available_time_slot', 'hospital', 'accepting_appointments', 'status'
    ];
}
