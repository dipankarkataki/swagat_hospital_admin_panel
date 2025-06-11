<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioLinkedHospital extends Model
{
    use SoftDeletes;

    protected $table = 'portfolio_linked_hospitals';
    protected $fillable = [
        'portfolio_id', 'hospital_id', 'status'
    ];

    public function hospitals(){
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }

    public function portfolio(){
        return $this->belongsTo(Portfolio::class, 'portfolio_id', 'id');
    }

    public function opdTimings(){
        return $this->hasMany(OpdTiming::class, 'portfolio_id', 'id');
    }
}
