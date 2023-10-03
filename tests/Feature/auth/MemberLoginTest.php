<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MemberLoginTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function member_can_view_login_page()
    {
        $this
            ->get(route('auth.member.login.page'))
            ->assertStatus(200);
    }

    /** @test */
    public function member_can_login()
    {
        // create a dummy user
        $user = factory(User::class)->create();

        // make a post request to login with creds and assert if redirected to dashboard on successful
        $res = $this
            ->post(route('auth.member.login'), [
                'username'  => $user->username,
                'password'  => 'password',
            ], [
                'accept' => 'application/json'
            ])
            ->assertRedirect('/member/dashboard');

        // ensure the user is logged in
        $this->assertTrue(auth()->check());
    }

}
