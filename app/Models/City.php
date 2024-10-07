<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function rates()
    {
        return $this->hasMany(Rate::class); //don't forget to import
    }
}
