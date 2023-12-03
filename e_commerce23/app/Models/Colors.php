<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;
    public static function colors(){

        $colors=Colors::where('status',1)->get()->toArray();
        return $colors;
    }
}
