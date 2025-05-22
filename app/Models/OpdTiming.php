<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpdTiming extends Model
{
    protected $table = "opd_timings";
    protected $fillable = [
        'portfolio_id', 'hospital_id', 'opd_date', 'opd_start_time', 'opd_end_time'
    ];
}
