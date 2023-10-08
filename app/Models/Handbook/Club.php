<?php

namespace App\Models\Handbook;

use App\Models\Users\UserClub;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Club
 *
 * Запис про клуб
 *
 * @package App\Models\Handbook
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class Club extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    public function country():HasOne
    {
        return $this->hasOne(Country::class,'code','country_code');

    }

    public function users():HasMany{

        return $this->hasMany(UserClub::class,'club_id','id','user');
    }


    public function criteria():HasMany
    {
        return $this->HasMany(ClubCriterion::class,
            'club_id',
            'id'
        );
    }

}
