<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'price','price2','price3', 'image','brand_id','tag','tag2','tag3'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors_sizes')
                    ->withPivot('size_id', 'quantity');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_colors_sizes')
                    ->withPivot('color_id', 'quantity');
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        
        return $this->reviews()->avg('rating');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }
}
