<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicAnnouncement extends Model
{
    use SoftDeletes;

    protected $table = 'academic_announcements';
    protected $fillable = ['name', 'type', 'start_date', 'end_date', 'description', 'status'];

    public function academic_media(){
        return $this->hasMany(AcademicMedia::class, 'academic_announcement_id', 'id');
    }
}
