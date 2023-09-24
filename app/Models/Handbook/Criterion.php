<?php

namespace App\Models\Handbook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Criterion
 *
 *
 * @package App\Models\Handbook
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class Criterion extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    public function scale(): HasOne
    {
        return $this->hasOne(Scale::class,'id','scale_id');
    }
}
