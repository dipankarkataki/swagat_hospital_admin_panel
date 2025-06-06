<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioRecentEvents extends Model
{
    protected $table = "portfolio_recent_events";
    protected $fillable = [
        'portfolio_id', 'title', 'description', 'event_date', 'media_type', 'media_thumbnail_link', 'media_link', 'status'
    ];

    public function portfolio(){
        return $this->belongsTo(Portfolio::class, 'portfolio_id', 'id');
    }
}
