<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabTestCategory extends Model
{
    use SoftDeletes;

    protected $table = 'lab_test_categories';
    protected $fillable = [ 'name', 'slug', 'status' ];
}
