<?php

namespace App\Http\Controllers;

use App\Domains\Tettwi\Models\Users\Username;
use App\Domains\Tettwi\Services\UserService;
use App\Http\Requests\ProfileUpdateRequest;
use App\Infrastructure\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
//        $UserService = new UserService(new UserRepository());
//        $info = $UserService->test($request->user()['id']);
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $UserName = new Username($request->username);

        //dd(($request->user()->username instanceof UserName), $request->user()->username);
        $request->user()->update([
            'username' => $UserName,
            'email' => $request->email,
        ]);
        //$request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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
