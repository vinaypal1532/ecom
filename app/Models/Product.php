<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'status',
        'subcategory_id',
        'image',
        'type',
        'discount_price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer'
    ];

    protected $hidden = [];

    
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
