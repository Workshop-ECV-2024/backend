<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    // make mass earth multiple

    public function getMassAttribute($value)
    {
        return $value / 5.97237e24;
    }
}
