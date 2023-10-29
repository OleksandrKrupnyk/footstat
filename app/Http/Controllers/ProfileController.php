<?php

namespace App\Http\Controllers;

use App\Contracts\ClubUserRepositoryContract;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 * Class ProfileController
 *
 * Контролер керування даними профайла користувача
 * @package App\Http\Controllers
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
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
        $request->validated();
        $user->fill($request->validated());
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
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
