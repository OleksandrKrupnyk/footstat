<?php

namespace App\Models\Handbook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Club extends Model
{
    use HasFactory;


    public function country():HasOne
    {
        return $this->hasOne(Country::class,'code','country_code');

    }
}
