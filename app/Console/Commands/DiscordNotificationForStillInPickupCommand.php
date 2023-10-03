<?php

namespace App\Console\Commands;

use App\Order;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\EachPromise;
use GuzzleHttp\Psr7\Response;
use Illuminate\Console\Command;

class DiscordNotificationForStillInPickupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eloking:discord:notify:readyForPickupOrders:still';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will send notification on discord about still in ready for pickup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Starting to check ready for pickup orders for discord notifications");
        $orders = $this->ordersReadyForPickup();

        $this->info("Found {$orders->count()} orders for sending message on Discord");

        $promises = $orders->map(function($order) {
            $payload = $this->getDiscordPayload($order);
            return $this->makeWebhookRequestToDiscord($order->gametype, $payload);
        })->toArray();

        $eachPromise = new EachPromise($promises, [
            // how many concurrency we are use
            'concurrency' => 10,
            'fulfilled' => function (Response $response) {
                if ($response->getStatusCode() == 200) {
                    $data = json_decode($response->getBody(), true);
                    // processing response of user here
                    $this->info('success::'.$data);
                }
            },
            'rejected' => function ($reason) {
                // handle promise rejected here
                $this->info('fail::'.$reason);
            }
        ]);

        $eachPromise->promise()->wait();

        return 0;
    }

    private function ordersReadyForPickup()
    {
        return Order::where('status', Order::STATUS_READY_FOR_PICKUP)
            ->where('created_at', '>=', now()->subMinutes(29)->seconds(0)->toDateTimeString())
            ->where('created_at', '<=', now()->subMinutes(29)->seconds(59)->toDateTimeString())
            ->get();
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
            "content" => "@here The Order #{$order->order_id} is still looking for booster",
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

        return $client->postAsync($webhook, [
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
