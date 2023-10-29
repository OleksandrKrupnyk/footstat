<?php

namespace App\Models\Handbook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * Class ClubCriterion
 *
 * Зв'язок клубу і критерію оцінювання
 *
 *
 * @property Scale $scale
 * @property Criterion $criterion
 * @package App\Models\Handbook
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
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


    public function scale(): HasOneThrough
    {
        return $this->hasOneThrough( // Звідки ClubCriterion
            Scale::class, // Куди Scale
            Criterion::class,// Через що Criterion
            'id',
            'id', // Ключ через
            'criterion_id',// Ключ звідки.criterion_id
            'scale_id', // Criterion.scale_id
        );
    }
}
