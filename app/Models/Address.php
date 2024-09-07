<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'user_id',
        'name',
        'mobile',
        'pincode',
        'locality',
        'city',
        'state',
        'address',
        'landmark',
        'alternate_phone',
        'priority',
    ];

    public function getNameAttribute($value)    {
       
        return ucwords($value);
    }
}
