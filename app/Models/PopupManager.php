<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupManager extends Model
{
    protected $table = 'popup_managers';
    protected $fillable = ['name', 'image', 'status'];
}
