<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'order_id' => 'LL' . uniqid(),
        'user_id' => function() {
            return factory(\App\User::class)->create();
        },
        'total_EUR' => 60,
        'payload' => [
            "type"          => "rank",
            "region"        => "EU",
            "options"       => ["duoq"],
            "gametype"      => "lol",
            "platform"      => "matchmaking",
            "currentLp"     => null,
            "queueType"     => null,
            "currentRank"   => "5",
            "customer_id"   => "1",
            "desiredRank"   =>"10"
        ],
        'status' => Order::STATUS_READY_FOR_PICKUP,
        'total' => 60,
        'currency' => 'EUR',
        'type' => 'rank',
        'gametype' => 'lol',
        'platform' => 'matchmaking',
        'payment_id' => uniqid(),
        'payment_gateway' => 'stripe',
        'booster_earning_EUR' => 33,
        'total_refunded_EUR' => 0,
        'region' => 'eu',
        'completed_at' => null,
        'order_total_EUR' => 60,
    ];
});
