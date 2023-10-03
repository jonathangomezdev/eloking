<?php

namespace App\Listeners;

use App\UserPayoutMethod;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserUpdaterListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        $payload = $event->payload ?? request()->all();


        if ($this->shouldUpdatePayout($event)) {
            $this->updatePayloadDetails($user, $payload);
        }
    }

    /**
     * @param $event
     * @return bool
     */
    public function shouldUpdatePayout($event)
    {
        if (! isset($event->payload['payout_method'])) {
            return false;
        }

        if (auth()->user()->hasRole('admin') && !empty($event->payload)) {
            return true;
        }

        return !(UserPayoutMethod::where('user_id', auth()->id())->exists());
    }

    /**
     * @param $user
     * @param $payload
     * @return mixed
     */
    public function updatePayloadDetails($user, $payload)
    {
        $this->disableAllPayoutMethods($user);

        return UserPayoutMethod::create([
            'user_id' => $user->id,
            'method'  => $payload['payout_method'],
            'details' => $this->refineDetails($payload),
            'active'  => UserPayoutMethod::STATUS_ACTIVE
        ]);
    }

    /**
     * @param $user
     * @return mixed
     */
    public function disableAllPayoutMethods($user)
    {
        return UserPayoutMethod::where('user_id', $user->id)->update(['active' => UserPayoutMethod::STATUS_INACTIVE]);
    }

    /**
     * @param $payload
     * @return array|void
     */
    public function refineDetails($payload)
    {
        switch ($payload['payout_method']) {
            case 'paypal':
                return $this->refineDetailsForPayPal($payload);
            case 'bank_transfer':
                return $this->refineDetailsForBank($payload);
            default:
                throw new \Exception('Incorrect Payout Method provided.');
        }
    }

    /**
     * @param $payload
     * @return array
     */
    public function refineDetailsForPayPal($payload)
    {
        return ['paypal_email' => $payload['paypal_email'], 'payout_method' => 'paypal'];
    }

    /**
     * @param $payload
     * @return \Illuminate\Support\Collection
     */
    public function refineDetailsForBank($payload)
    {
        return collect($payload)->only(['bank_name', 'bank_address', 'iban', 'swift_bic', 'recipient_full_name', 'bank_country', 'recipient_country', 'recipient_full_name', 'payout_method']);
    }
}
