<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Stats\Mark;
use App\Models\Users\UserClub;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 *
 * @property UserClub $userClub
 * @property Mark[] $marks
 *
 * @package App\Models
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email === 'admin@admin.ua'  && $this->hasVerifiedEmail();
    }


    public function userClub(): HasOne
    {
        return $this->hasOne(UserClub::class, 'user_id', 'id');
    }


    public function marks(): HasMany
    {
        return  $this->hasMany(Mark::class,'user_id','id');
    }



    public function mCount()
    {
        return Attribute::make(
            get: fn (string $value) => $value,
        );
    }
}
