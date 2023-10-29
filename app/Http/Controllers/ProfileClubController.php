<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileClubCreateRequest;
use App\Http\Requests\ProfileClubUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

/**
 * Class ProfileClubController
 *
 * Контролер
 * @package App\Http\Controllers
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class ProfileClubController extends Controller
{
    /**
     * Update the user's profile information.
     */
    public function update(ProfileClubUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->userClub()->update(
            [
                'opponent_club_id' => $request->opponent,
                'update_opponent_at' => now(),
            ]
        );
        return Redirect::route('profile.edit')->with('status', 'clubs-updated');
    }


    public function create(ProfileClubCreateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->userClub()->create(
            [
                'user_id' => $user->id,
                //
                'club_id' => $request->club,
                'update_club_at' => now(),
                //
                'opponent_club_id' => $request->opponent,
                'update_opponent_at' => now(),
            ]
        );
        return Redirect::route('profile.edit')->with('status', 'clubs-updated');
    }
}
