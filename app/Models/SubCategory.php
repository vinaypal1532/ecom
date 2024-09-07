<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';
    
    protected $fillable = [
        'name',
        'category_id',
        'description'
    ];

    // Define the attributes that should be hidden for arrays
    protected $hidden = [];

   
    protected $casts = [];

   
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }
}
