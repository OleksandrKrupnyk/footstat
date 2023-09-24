<?php

namespace App\Models\Handbook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClubCriterion extends Model
{
    use HasFactory;


    public function criterion(): HasOne
    {
        return $this->hasOne(Criterion::class,
            'id',
            'criterion_id');
    }


    public function club(): HasOne
    {
        return $this->hasOne(Club::class,
            'id',
            'club_id');
    }
}
