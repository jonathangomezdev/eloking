<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Models\Role;

class NewUserSetupListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        foreach (request()->gameRestrictions ?? [] as $game) {
            $event->user->boosterGameRestrictions()->create(['game' => $game]);
        }

        $event->user->roles()->attach(
            Role::whereIn('name', array_merge(request()->roles ?? [], ['member']))->get()
        );
    }
}
