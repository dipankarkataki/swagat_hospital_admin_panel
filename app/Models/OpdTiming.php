<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpdTiming extends Model
{
    use SoftDeletes;

    protected $table = "opd_timings";
    protected $fillable = [
        'portfolio_linked_hospital_id', 'portfolio_id', 'hospital_id', 'opd_date', 'opd_start_time', 'opd_end_time', 'status'
    ];

    public function portfolio(){
        return $this->belongsTo(Portfolio::class, 'portfolio_id', 'id');
    }

    public function hospital(){
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }
}
