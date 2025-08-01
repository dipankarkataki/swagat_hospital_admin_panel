<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    
    protected $table = 'departments';
    protected $fillable = ['name', 'status'];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'department_id', 'id');
    }

    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }
}
