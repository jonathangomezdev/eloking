<?php

namespace App;

use App\Service\MasterLPCalculationService;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    public $calculateSuccess = 1;

    /**
     * Returns a list of ranks together with their prices.
     *
     * @param $gametype
     * @return mixed
     */
    public static function list($gametype)
    {
        $ranks = Rank::where('gametype', $gametype)
            ->orderBy('sequence', 'asc')
            ->get();

        return $ranks;
    }

    /**
     * Calculates totals for selected boost.
     *
     * @param $gametype
     * @param $platform
     * @param $type
     * @param $currentRank
     * @param $desiredRank
     * @param $options
     * @param $currentLp
     * @return array
     */
    public function calculate($gametype, $platform, $type, $currentRank, $desiredRank, $options = null, $currentLp = null, $currentLPMaster = null, $desiredLPMaster = null)
    {
        switch ($type) {
            case 'rank':
                $calculation = Rank::where('gametype', $gametype)
                    ->where('platform', $platform)
                    ->where('type', $type)
                    ->where('sequence', '>=', $currentRank)
                    ->where('sequence', '<', $desiredRank)
                    ->orderBy('sequence', 'asc')
                    ->get();

                $price = $this->calculateRank($calculation);
                break;

            case 'win':
                $calculation = Rank::where('gametype', $gametype)
                    ->where('platform', $platform)
                    ->where('type', $type)
                    ->where('sequence', '=', $currentRank)
                    ->orderBy('sequence', 'asc')
                    ->get();

                $winPrice = $calculation->first()->price;
                $price = $this->calculateWin($winPrice, $desiredRank);
                break;

            case 'placement':
                $price = $this->calculatePlacement($gametype, $platform, $currentRank, $desiredRank);
                break;

            default:
                $this->calculateSuccess = 0;
        }

        if ($options) {
            $price = $this->adjustForOptions($gametype, $platform, $options, $price);
        }

        if (($currentLp || $currentLPMaster) && $type == 'rank') {
            $price = $this->adjustForLp($gametype, $platform, $currentLp, $currentRank, $desiredRank, $price, $currentLPMaster, $desiredLPMaster);
        }

        $addons = $this->calculateAddons($gametype, $platform, $options, $price, $desiredRank);

        $grandTotal = $price + $addons;
        $grandTotalCompetitor = $grandTotal * 1.3;

        if ($this->calculateSuccess !== 1) {
            $data = ['success' => 0];
        } else {
            $data = [
                'success' => $this->calculateSuccess,
                'price' => currency($price),
                'addons' => currency($addons),
                'total' => currency($grandTotal),
                'currency' => session('user.currency', 'EUR'),
                'total_EUR' => convertToCurrency($grandTotal, 'EUR'),
                'total_competitor' => currency($grandTotalCompetitor),
                'total_formatted' => currencyFormatted($grandTotal),
                'total_competitor_formatted' => currencyFormatted($grandTotalCompetitor)
            ];
        }

        return $data;
    }

    /**
     * Returns price by rank.
     *
     * @param $calculation
     * @return int
     */
    public function calculateRank($calculation)
    {
        $price = 0;

        foreach ($calculation as $rank) {
            $price += $rank->price;
        }

        return $price;
    }

    /**
     * Returns price by wins.
     *
     * @param $winPrice
     * @param $desiredWins
     * @return float|int
     */
    public function calculateWin($winPrice, $desiredWins)
    {
        return $winPrice * $desiredWins;
    }

    /**
     * Calculates placement price.
     *
     * @param $gametype
     * @param $platform
     * @param $desiredRank
     * @return false|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function calculatePlacement($gametype, $platform, $currentRank, $desiredRank)
    {
        $allowedGametypes = array_keys(config('prices.placements'));
        if (!in_array($gametype, $allowedGametypes) || $desiredRank < 1 || $desiredRank > 10) {
            $this->calculateSuccess = 0;
            return false;
        }

        $allowedPlatforms = array_keys(config('prices.placements.' . $gametype));
        if (!in_array($platform, $allowedPlatforms)) {
            $this->calculateSuccess = 0;
            return false;
        }

        if ($gametype == 'csgo') {
            $placementPrice = (float)config('prices.placements.csgo.' . $platform);
            return $placementPrice * $desiredRank;
        }

        try {
            $placementPrice = (float)config('prices.placements.' . $gametype . '.' . $platform)[$currentRank];
        } catch (\Exception $ex) {
            $this->calculateSuccess = 0;
            return false;
        }
        return $placementPrice * $desiredRank;
    }

    /**
     * Adjust price for selected options.
     *
     * @param $gametype
     * @param $platform
     * @param $options
     * @param $price
     *
     * @return float
     */
    public function adjustForOptions($gametype, $platform, $options, $price)
    {
        $adjustedPrice = $price;

        if ($gametype == 'csgo' && $platform == 'matchmaking') {
            foreach ($options as $option) {
                if ($option == 'wingman') {
                    $wingmanAdjustment = floatval(config('prices.optionAdjustments.csgo.wingman'));
                    $adjustedPrice = $adjustedPrice - ($price * $wingmanAdjustment);
                }
            }
        }

        return $adjustedPrice;
    }

    /**
     * Adjust price for current League Points (LP).
     *
     * @param $gametype
     * @param $platform
     * @param $currentLp
     * @param $currentRank
     * @param $price
     *
     * @return float
     */
    public function adjustForLp($gametype, $platform, $currentLp, $currentRank, $desiredRank, $price, $currentLPMaster, $desiredLPMaster)
    {
        $adjustedPrice = $price;

        if ($gametype == 'lol' || $gametype == 'valorant') {
            if ($currentRank == 25 && $gametype == 'lol') {
                $adjustedPrice = MasterLPCalculationService::calculate($currentLPMaster, $desiredLPMaster);
            } elseif ($desiredRank == 25 && $gametype === 'lol' && $desiredLPMaster != 0) {
                $adjustedPrice = MasterLPCalculationService::calculate(0, $desiredLPMaster);
                $adjustedPrice = $price + $adjustedPrice;
            } elseif (intval($currentLp > 0 && $currentLp <= 5)) {
                $lpAdjustment = floatval(
                        config('prices.currentLpAdjustments.' . $gametype . '.' . intval($currentLp))
                    );

                $calculation = Rank::where('gametype', $gametype)
                    ->where('platform', $platform)
                    ->where('type', 'rank')
                    ->where('sequence', '=', $currentRank)
                    ->orderBy('sequence', 'asc')
                    ->get();

                $rankPrice = $calculation->first()->price;

                $adjustedPrice = $adjustedPrice - ($rankPrice * $lpAdjustment);
            }
        }

        return $adjustedPrice;
    }

    /**
     * Calculates selected add-on price.
     *
     * @param $gametype
     * @param $platform
     * @param $options
     * @param $price
     * @param $desiredRank
     *
     * @return float
     */
    public function calculateAddons($gametype, $platform, $options, $price, $desiredRank)
    {
        $addons = 0;

        if (!$options) {
            return $addons;
        }

        foreach ($options as $option) {
            if ($option == 'duoq') {
                $addonMultiplied = floatval(config('prices.addons.duoq'));
                $addons = $addons + ($price * $addonMultiplied);
            } else if ($option == 'live_stream') {
                $addonMultiplied = floatval(config('prices.addons.live_stream'));
                $addons = $addons + ($price * $addonMultiplied);
            } else if ($option == 'priority_order') {
                $addonMultiplied = floatval(config('prices.addons.priority_order'));
                $addons = $addons + ($price * $addonMultiplied);
            } else if ($option == 'coaching') {
                $addonMultiplied = floatval(config('prices.addons.coaching'));
                $addons = $addons + ($price * $addonMultiplied);
            } else if ($option == 'extra_win') {
                $calculation = Rank::where('gametype', $gametype)
                    ->where('platform', $platform)
                    ->where('type', 'win')
                    ->where('sequence', '=', $desiredRank)
                    ->orderBy('sequence', 'asc')
                    ->get();

                $winPrice = $calculation->first()->price;
                $addons = $addons + $winPrice;
            }
        }

        return $addons;
    }

    /**
     * Format currency.
     *
     * @param $amount
     * @param string $currency
     * @return string
     */
    public function formatCurrency($amount, $currency = 'EUR')
    {
        switch ($currency) {
            default:
                $formatted = '€' . number_format($amount, 2);
        }

        return $formatted;
    }

    public static function getRankBySequence($gametype, $platform, $sequence)
    {
        return Rank::where('gametype', $gametype)->where('platform', $platform)->where('sequence', $sequence)->first();
    }
}
