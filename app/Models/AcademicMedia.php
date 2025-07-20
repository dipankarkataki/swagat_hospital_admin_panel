<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicMedia extends Model
{
    use SoftDeletes;
    protected $table = 'academic_media';
    protected $fillable = ['academic_announcement_id', 'type', 'photo', 'doc'];
}
