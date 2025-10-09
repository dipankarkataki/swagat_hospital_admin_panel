<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioReview extends Model
{
    protected $table = 'portfolio_reviews';
    protected $fillable = [
        'portfolio_id', 'name', 'review', 'rating', 'status'
    ];
}
