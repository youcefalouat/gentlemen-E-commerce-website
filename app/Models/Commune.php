<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = ['matricule','nom','wilaya_id'];

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }

    function clients() {
        return $this->hasMany(Client::class);
    }
}
