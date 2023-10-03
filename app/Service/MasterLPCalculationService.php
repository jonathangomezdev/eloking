<?php

namespace App\Service;

class MasterLPCalculationService
{

    public static function calculate($currentLP, $desiredLP)
    {
        $Lps = self::calculateLps($currentLP, $desiredLP);

        $baseLpPrice = config('prices.currentLpAdjustments.lol_masters_base_price');
        $lpIncrements = config('prices.currentLpAdjustments.lol_masters');

        $totalLpPrice = 0;
        foreach($Lps as $index => $diff) {
            $totalLpPrice += $diff * ($baseLpPrice * $lpIncrements[$index]);
        }

        return $totalLpPrice;
    }

    public static function calculateLps($currentLP, $desiredLP)
    {
        $Lps = [];

        if (self::getNumberIndex($currentLP) == self::getNumberIndex($desiredLP)) {
            $Lps[(self::getNumberIndex($desiredLP) + 1)] = $desiredLP - $currentLP;
            return $Lps;
        }

        $count = ($currentLP + 1);


        while($count < self::getNext100($desiredLP)) {

            $next100 = self::getNext100($count);
            $diff = ($next100 + 1) - $count;
            $index = self::getNumberIndex($next100);

            $Lps[$index] = $diff;

            $count = ($next100 + 1);

            if ($count >= $desiredLP) {
                $Lps[$index] = ( ($index * 100) - $desiredLP) * -1;
            }
        }

        return $Lps;
    }

    public static function getNext100($value){
        return ceil($value / 100) * 100;
    }

    public static function getNumberIndex($num){
        if ($num < 100) {
            return 0;
        }
        return (substr((string)($num - 100), 0, 1));
    }

}
