<?php

namespace App\Http\Controllers\Admin;

use App\BoosterGameRestriction;
use App\Events\UserUpdatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $title = 'User Management';

        return view('panel.admin.user.index', [
            'users' => User::filter($request->all())->paginate(10),
            'title' => $title,
        ]);
    }

    public function edit(User $user)
    {
        return view('panel.admin.user.edit', [
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        unset($data['password']);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $data['allow_notification_sound'] = $request->filled('allow_notification_sound');
        $data['allow_email_notifications'] = $request->filled('allow_email_notifications');
        $data['allow_coaching_orders'] = $request->filled('allow_coaching_orders');
        $data['allow_notifications_in_discord'] = $request->filled('allow_notifications_in_discord');

        $roles = $request->roles ?? [];
        $roles[] = 'member';

        $user->roles()->sync(Role::whereIn('name', $roles)->get());

        // When the role booster is removed. We would like to remove user's booster related data
        if (! $user->hasRole('booster')) {
            $data = array_merge($data, [
                'company_name' => '',
                'street' => '',
                'city' => '',
                'state' => '',
                'country' => '',
                'postcode' => '',
                'vat_rate' => null,
                'vat_number' => '',
            ]);
            $user->boosterGameRestrictions()->delete();
        }

        $user->fresh()->update($data);

        if ($user->hasRole('booster')) {
            $user->boosterGameRestrictions()->delete();
            foreach ($request->gameRestrictions ?? [] as $game) {
                $user->boosterGameRestrictions()->create(['game' => $game]);
            }
        }

        event(new UserUpdatedEvent($user, $request->all()));

        session()->flash('success', 'User has been updated');
        return redirect('/panel/admin/user/' . $user->id . '/edit');
    }

    public function create()
    {
        $title = 'Create User';

        return view('panel.admin.user.create', [
            'title' => $title,
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $payload = $request->validated();
        if (! $payload['username']) {
            $payload['username'] = User::generateUsername($request->email);
        }

        $user = User::create(
                    array_merge(
                        $payload,
                        [
                            'password' => Hash::make($request->password),
                            'allow_notification_sound' => $request->filled('allow_notification_sound'),
                            'allow_email_notifications' => $request->filled('allow_email_notifications'),
                            'allow_coaching_orders' => $request->filled('allow_coaching_orders'),
                        ]
                    )
                );

        event(new Registered($user));

        session()->flash('success', 'User has been created');
        return redirect('/panel/admin/user');
    }

    public function destroy(User $user)
    {

        $user->delete();
        session()->flash('success', 'User has been deleted');
        return redirect('/panel/admin/user');
    }

}
