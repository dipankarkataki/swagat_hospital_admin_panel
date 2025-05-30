<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use SoftDeletes;

    protected $table = 'portfolios';
    protected $fillable = [
        'department_id', 'profile_pic', 'full_name', 'email', 'qualification', 'experience', 'languages_speak', 'brief_description', 'expertise',
        'membership', 'research', 'awards', 'status'
    ];

    public function portfolioLinkedHospital()
    {
        return $this->hasMany(PortfolioLinkedHospital::class, 'portfolio_id', 'id');
    }

    public function departments(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
