<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'status', 'total_amount', 'shipping_address', 'payment_status','nom','prenom','wilaya_id','commune_id','telephone'];

    /*public function client()
    {
        return $this->belongsTo(User::class);
    }*/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Match the foreign key name in your database
    }

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class, 'wilaya_id'); // Match the foreign key name in your database
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_id'); // Match the foreign key name in your database
    }
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

