<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferFestival extends Model
{
    protected $fillable = ['offer_id', 'festival_name'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
