<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabTestPackage extends Model
{
    use SoftDeletes;

    protected $table = 'lab_test_packages';
    protected $fillable = [
        'lab_test_category_id', 'name', 'description', 'lab_test_id', 'full_price', 'discount', 'discounted_price', 'status'
    ];

    public function labTestCategory(){
        return $this->belongsTo(LabTestCategory::class, 'lab_test_category_id', 'id');
    }

    public function labTest(){
        return $this->belongsTo(LabTest::class, 'lab_test_category_id', 'lab_test_category_id');
    }
}
