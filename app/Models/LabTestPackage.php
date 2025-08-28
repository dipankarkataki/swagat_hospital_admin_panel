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

    public function categories()
    {
        return $this->belongsToMany(
            LabTestCategory::class,          // related model
            'lab_test_package_categories',   // pivot table
            'lab_test_package_id',           // foreign key for current model
            'lab_test_category_id'           // foreign key for related model
        )->withTimestamps();
    }

    public function labTest(){
        return $this->belongsTo(LabTest::class, 'lab_test_category_id', 'lab_test_category_id');
    }
}
