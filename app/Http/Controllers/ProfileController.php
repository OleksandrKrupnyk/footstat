<?php

namespace App\Http\Controllers;

use App\Contracts\ClubUserRepositoryContract;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{


    private ClubUserRepositoryContract $clubUserRepository;

    public function __construct(ClubUserRepositoryContract $clubUserRepository)
    {
        $this->clubUserRepository = $clubUserRepository;
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $clubs = $this->clubUserRepository->getAllClubs();

        return view('profile.edit', [
            'user' => $request->user(),
            'clubs' => $clubs,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        if(!$user->userClub) {
            $user->userClub()->create(['user_id' => $user->id, 'club_id' => $request->club]);
        }
//else{
//            //$user->userClub()->update(['user_id' => $user->id, 'club_id' => $request->club]);
//        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
