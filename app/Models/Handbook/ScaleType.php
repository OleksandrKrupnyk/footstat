<?php

namespace App\Models\Handbook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ScaleType
 *
 * Довідник типу шкал оцінювання
 *
 * @package App\Models\Handbook
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class ScaleType extends Model
{
    use HasFactory;

    protected static $unguarded = true;
}
