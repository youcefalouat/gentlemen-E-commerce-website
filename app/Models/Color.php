<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['name', 'code', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_colors_sizes')
                    ->withPivot('size_id', 'quantity');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_colors_sizes')
                    ->withPivot('product_id', 'quantity')
                    ->wherePivot('product_id', $this->pivot->product_id);
    }

}

