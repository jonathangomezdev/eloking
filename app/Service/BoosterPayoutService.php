<?php

namespace App\Service;


use App\BoosterOrder;
use App\Rank;

class BoosterPayoutService
{
    public static function calculatePayout($orders, $boosterId)
    {
        $orders->each(function($order) use ($boosterId) {
            $order->payout_eligible = self::calculateOrderPayout($order, $boosterId);
        });

        return $orders;
    }

    public static function calculateOrderPayout($order, $boosterId)
    {
        $earning = $order->booster_earning_EUR;

        if (! $order->isDropped()) {
            return $earning;
        }

        $booster = BoosterOrder::where('order_id', $order->id)->where('booster_id', $boosterId)->first();

        if ($booster && $booster->total) {
            return $booster->total;
        }

        if (isset($booster->drop_comment)) {
            $boosterEarning = self::rankDifferenceCalculate($order, $order->payload['currentRank'], $booster->progressed_rank, $booster->current_lp);
            if (! $booster->penalty) {
                return $boosterEarning;
            }
            $earning = ($boosterEarning - ($earning * 0.10));
        } else {
            $progressedRank = BoosterOrder::where('order_id', $order->id)->whereNotNull('drop_comment')->latest()->first();

            if ($progressedRank->total) {
                return $progressedRank->total < 0 ? $earning + ($progressedRank->total * -1) : $earning - $progressedRank->total;
            }

            $boosterEarning = self::rankDifferenceCalculate($order, $progressedRank->progressed_rank, $order->payload['desiredRank'], $progressedRank->current_lp);

            if (! $progressedRank->penalty) {
                return $boosterEarning;
            }
            $earning = ($boosterEarning + ($earning * 0.10));
        }

        return $earning;
    }

    public static function rankDifferenceCalculate($order, $currentRank, $desiredRank, $currentLp)
    {
        $price = self::getRankPrice($order, $currentRank, $desiredRank, $currentLp);

        $earningPercent = ($order->booster_earning_EUR / $order->total_EUR) * 100;

        return ($price['total_EUR'] / 100) * $earningPercent;
    }

    public static function getRankPrice($order, $currentRank, $desiredRank, $currentLp)
    {
        $options = $order->payload['options'] ?? [];
        if($currentLp) {
            $options['currentLp'] = $currentLp;
        }
        return (new Rank())
            ->calculate(
                $order->gametype,
                $order->platform,
                $order->type,
                intval($currentRank),
                intval($desiredRank),
                $options
            );
    }
}
