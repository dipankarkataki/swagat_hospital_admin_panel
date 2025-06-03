<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioLinkedHospital extends Model
{
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
}
