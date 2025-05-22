<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioLinkedHospital extends Model
{
   protected $table = 'portfolio_linked_hospitals';
   protected $fillable = [
    'portfolio_id', 'hospital_id', 'status'
   ];
}
