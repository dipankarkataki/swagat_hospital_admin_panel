<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioRecentEvents extends Model
{
    protected $table = "portfolio_recent_events";
    protected $fillable = [
        'portfolio_id', 'title', 'description', 'media_type', 'media_thumbnail_link', 'media_link', 'status'
    ];
}
