<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabTest extends Model
{
    use SoftDeletes;

    protected $table = 'lab_tests';
    protected $fillable = [
        'lab_test_category_id', 'name', 'icon', 'description', 'price', 'status'
    ];

    public function labTestCategory(){
        return $this->belongsTo(LabTestCategory::class, 'lab_test_category_id', 'id');
    }

    public function labTestPackage(){
        return $this->belongsTo(LabTestPackage::class, 'lab_test_category_id', 'lab_test_category_id');
    }
}
