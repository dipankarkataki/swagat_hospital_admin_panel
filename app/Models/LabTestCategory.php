<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabTestCategory extends Model
{
    use SoftDeletes;

    protected $table = 'lab_test_categories';
    protected $fillable = [ 'name', 'slug', 'status' ];

    // Many-to-many with packages
    public function packages()
    {
        return $this->belongsToMany(
            LabTestPackage::class,
            'lab_test_package_categories',
            'lab_test_category_id',
            'lab_test_package_id'
        );
    }
}
