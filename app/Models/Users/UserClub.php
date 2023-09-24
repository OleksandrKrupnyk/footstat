<?php

namespace App\Models\Users;

use App\Models\Handbook\Club;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class UserClub
 *
 * Запис, що пов'язує користувача за клубом
 *
 * @property Club $club
 *
 * @package App\Models\Users
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class UserClub extends Model
{
    use HasFactory;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id', 'users');
    }


    public function club(): HasOne
    {
        return $this->hasOne(Club::class, 'id', 'club_id');
    }
}
