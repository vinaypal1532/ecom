<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title', 'description', 'type', 'discount_percentage', 'start_date', 'end_date', 'status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function festivals()
    {
        return $this->hasMany(OfferFestival::class);
    }

    public function seasons()
    {
        return $this->hasMany(OfferSeason::class);
    }
}
