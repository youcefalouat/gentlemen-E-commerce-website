<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name', 'description'];

    public function products()
        {
            return $this->belongsToMany(Product::class, 'product_colors_sizes')
                        ->withPivot('color_id', 'quantity');
        }

    public function categories()
        {
            return $this->belongsToMany(Category::class, 'category_sizes');
        }

}

