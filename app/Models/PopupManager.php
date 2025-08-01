<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopupManager extends Model
{
    use SoftDeletes;

    protected $table = 'popup_managers';
    protected $fillable = ['name', 'image', 'status'];
}
