<?php

namespace App\Listeners;

use App\Notifications\BoosterPayoutCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BoosterPayoutCreatedListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->boosterPayout->booster->notify(
            new BoosterPayoutCreatedNotification($event->boosterPayout)
        );
    }
}
