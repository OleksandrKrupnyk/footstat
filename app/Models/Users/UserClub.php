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
 * @property Club $opponent
 *
 * @package App\Models\Users
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class UserClub extends Model
{
    use HasFactory;


    public $fillable = [
        'user_id',
        'club_id',
        'update_club_at',
        'opponent_club_id',
        'update_opponent_at',
    ];

    public $casts = [
        'update_club_at' => 'datetime',
        'update_opponent_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id', 'users');
    }


    public function club(): HasOne
    {
        return $this->hasOne(Club::class, 'id', 'club_id');
    }

    public function opponent(): HasOne
    {
        return $this->hasOne(Club::class, 'id', 'club_id');
    }
}
