<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'category_sizes');
    }
    
}

