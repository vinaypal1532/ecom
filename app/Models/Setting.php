<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
       
        'email',
        'mobile_no',
        'address',
        'gst_no',
        'pan_card',
        'logo',
        'title',
    ];
}
