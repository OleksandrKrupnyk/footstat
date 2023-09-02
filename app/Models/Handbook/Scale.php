<?php

namespace App\Models\Handbook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Scale
 *
 * Запис довіднику шкала
 *
 * @package App\Models\Handbook
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class Scale extends Model
{
    use HasFactory;

    /**
     * @return HasOne
     */
    public function scaleType(): HasOne
    {
        return $this->hasOne(ScaleType::class, 'type', 'scale_type');
    }

    public function values(): HasMany
    {
        return $this->hasMany(ScaleValue::class, 'scale_id','id');
    }
}
