<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class Carts extends Model
{
    use HasFactory;
    protected $table='carts';
   
    public function product(){
        return $this->belongsTo(Products::class,'product_id')->with('brand','images');
    }
}
