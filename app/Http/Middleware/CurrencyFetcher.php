<?php

namespace App\Http\Middleware;

use Closure;

class CurrencyFetcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session('user.currency')) {
            $country = $_SERVER["HTTP_CF_IPCOUNTRY"] ?? 'LV';
            $region  = $this->getRegion($country);

            session()->put('user.region', $region);
            session()->put('user.regionCode', $this->getRegionCode($region));
            session()->put('user.country', $country);
            session()->put('user.currency', countryToCurrency($country));
        }

        return $next($request);
    }

    public function getRegion($countryCode)
    {
        switch ($countryCode) {
            case 'US':
            case 'CA':
            case 'NA':
                return 'North America';
            case 'BY':
            case 'BG':
            case 'CZ':
            case 'HU':
            case 'MD':
            case 'PL':
            case 'RO':
            case 'RU':
            case 'SK':
            case 'UA':
                return 'East Europe';
            case 'DK':
            case 'FI':
            case 'IS':
            case 'NO':
            case 'SE':
                return 'North Europe';
            case 'AU':
            case 'PG':
            case 'FJ':
            case 'NZ':
            case 'SB':
            case 'FM':
            case 'WS':
            case 'KI':
            case 'TO':
            case 'MH':
            case 'PW':
            case 'TV':
            case 'NR':
                return 'Oceania';
            case 'MX':
            case 'Haiti':
                return 'Latin America North';
            case 'CO':
            case 'AR':
                return 'Latin America South';
            case 'AT':
            case 'BE':
            case 'HR':
            case 'CY':
            case 'EE':
            case 'FR':
            case 'DE':
            case 'GR':
            case 'IE':
            case 'IT':
            case 'LV':
            case 'LT':
            case 'LU':
            case 'MT':
            case 'NL':
            case 'PT':
            case 'SI':
            case 'ES':
            case 'GB':
                return 'Europe';
            default:
                return 'West Europe';
        }
    }

    public function getRegionCode($region)
    {
        switch ($region) {
            case 'North America':
                return 'NA';
            case 'East Europe':
            case 'North Europe':
            case 'West Europe':
            case 'Europe':
                return 'EU';
            case 'North America':
            case 'Latin America North':
            case 'Latin America South':
                return 'US';
            case 'Oceania':
                return 'OCE';
            default:
                return 'glob';
        }
    }
}
