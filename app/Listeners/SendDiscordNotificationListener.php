<?php

namespace App\Listeners;

use App\Order;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDiscordNotificationListener
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
        $payload = $this->getDiscordPayload($event->order);
        $this->makeWebhookRequestToDiscord($event->order->gametype, $payload);
    }

    private function getDiscordPayload(Order $order)
    {
        $desiredRank = $order->type === 'rank' ? $order->rankName('desiredRank') : "By Win (" . $order->payload['desiredRank'] . ")";
        $currentRank = $order->rankName('currentRank');

        $details = [];
        $details = array_merge($details, $order->payload['options'] ?? []);

        if (isset($order->payload['queueType'])) {
            $details[] = $order->payload['queueType'];
        }

        if (isset($order->payload['currentLp'])) {
            $details[] = config('prices.currentLpDisplayTexts.' . $order->gametype . '.' . intval($order->payload['currentLp']));
        }

        if ($order->type === 'win') {
            $ranks = $currentRank . ' ' . $desiredRank;
        } else {
            $ranks = $currentRank . ' - ' . $desiredRank;
        }

        $details = array_map(function($item) {
            return str_replace('_', ' ', ucfirst($item));
        }, $details);

        if (count($details) > 0) {
            $details = $ranks . ', ' . join(', ', $details);
        } else {
            $details = $ranks;
        }

        return [
            "username" => "Eloking Bot",
            "avatar_url" => "https://eloking.com/img/logo.svg",
            "content" => "Order #{$order->order_id} for the amount of €{$order->booster_earning_EUR} is ready to be picked up. @here",
            "embeds" => [
                [
                    "title"=> "Order #{$order->order_id} in {$order->getGAmeType()}",
                    "url" => "https://eloking.com/panel/jobs",
                    "fields" => [
                        [
                            "name" => "Details",
                            "value" => $details,
                        ],
                        [
                            "name" => "Region",
                            "value" => $order->getRegionName(),
                        ]
                    ]
                ]
            ]
        ];
    }

    public function makeWebhookRequestToDiscord($gametype, $payload)
    {
        $webhook = $this->getWebhook($gametype);
        $client = new Client();

        return $client->post($webhook, [
            'json' => $payload,
        ]);
    }

    public function getWebhook($gametype)
    {
        switch ($gametype) {
            case 'csgo':
                return env('DISCORD_CSGO_WEBHOOK');
            case 'lol':
                return env('DISCORD_LOL_WEBHOOK');
            case 'valorant':
                return env('DISCORD_VALORANT_WEBHOOK');
            default:
                return '';
        }
    }
}
