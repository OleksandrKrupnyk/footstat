<?php
namespace App\Repositories;

use App\Contracts\ClubUserRepositoryContract;
use App\Models\Handbook\Club;

/**
 * Class ClubUserRepository
 *
 *
 * @package App\Repositories
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class ClubUserRepository implements ClubUserRepositoryContract
{

    public function getAllClubs()
    {
        return Club::query()->select(['id','title'])->get()->toArray();
    }
}
