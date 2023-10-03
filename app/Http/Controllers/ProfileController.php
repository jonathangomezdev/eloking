<?php

namespace App\Http\Controllers;

use App\Events\UserUpdatedEvent;
use App\Http\Requests\ProfileUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * It will load user profile page with form to update data
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $title = 'Edit Profile';

        return view('panel.member.profile', [
            'user' => auth()->user(),
            'title' => $title,
        ]);
    }

    /**
     * It will update user's profile
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();

        $payload = $request->validated();

        unset($payload['password']);
        if ($request->password) {
            $payload['password'] = Hash::make($request->password);
        }

        $payload['allow_notification_sound'] = $request->filled('allow_notification_sound');
        $payload['allow_email_notifications'] = $request->filled('allow_email_notifications');
        $payload['allow_notifications_in_discord'] = $request->filled('allow_notifications_in_discord');

        $user->update($payload);

        event(new UserUpdatedEvent($user, $request->all()));

        session()->flash('success', 'Profile has been updated');
        return redirect()->back();
    }
}
