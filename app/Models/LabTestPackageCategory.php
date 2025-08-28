<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabTestPackageCategory extends Model
{
    protected $table = 'lab_test_package_categories';
    protected $fillable = ['lab_test_package_id', 'lab_test_category_id'];
}
