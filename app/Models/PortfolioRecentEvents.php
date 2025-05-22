<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioRecentEvents extends Model
{
    protected $table = "portfolio_recent_events";
    protected $fillable = [
        'portfolio_id', 'media_type', 'media_link', 'status'
    ];
}
