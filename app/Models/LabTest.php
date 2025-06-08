<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabTest extends Model
{
    use SoftDeletes;

    protected $table = 'lab_tests';
    protected $fillable = [
        'lab_test_category_id', 'name', 'description', 'price', 'status'
    ];
}
