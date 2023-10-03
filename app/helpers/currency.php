<?php

function currencyFormatted($amount, $currency = null, $calculated = false)
{
    if (!$currency) {
        $currency = session('user.currency', 'EUR');
    }
    $symbol = getCurrencySymbol($currency);

    if ($calculated) {
        return $symbol . round($amount, 2);
    }

    return $symbol . currency($amount);
}

function currency($amount)
{
    return convertToCurrency($amount, session('user.currency'));
}

function convertToCurrency($amount, $currency = 'EUR')
{
    return round($amount * config('prices.convertor.EUR_TO_' . $currency), 2);
}

function convertToCurrencyFormatted($amount, $currency = 'EUR')
{
    return getCurrencySymbol($currency) . convertToCurrency($amount, $currency);
}

function convertCurrency($amount, $currency, $toCurrency)
{
    if (strtoupper($currency) == 'EUR' && strtoupper($toCurrency) === 'USD') {
        return $amount * config('prices.convertor.EUR_TO_USD');
    }

    if (strtoupper($currency) == 'EUR' && strtoupper($toCurrency) === 'GBP') {
        return $amount * config('prices.convertor.EUR_TO_GBP');
    }

    if (strtoupper($currency) == 'USD' && strtoupper($toCurrency) === 'EUR') {
        return $amount / config('prices.convertor.EUR_TO_USD');
    }

    if (strtoupper($currency) == 'GBP' && strtoupper($toCurrency) === 'EUR') {
        return $amount / config('prices.convertor.EUR_TO_GBP');
    }
}

function getCurrencySymbol($currency)
{
    return [
        'EUR' => '€',
        'GBP' => '£',
        'USD' => '$',
    ][strtoupper($currency)];
}

function countryToCurrency($country)
{
    $mapCountryCurrency = [
        'AD' => 'EUR',
        'AS' => 'USD',
        'AT' => 'EUR',
        'AX' => 'EUR',
        'BE' => 'EUR',
        'BL' => 'EUR',
        'BQ' => 'USD',
        'CA' => 'USD',
        'CY' => 'EUR',
        'DE' => 'EUR',
        'EC' => 'USD',
        'EE' => 'EUR',
        'ES' => 'EUR',
        'FI' => 'EUR',
        'FR' => 'EUR',
        'GB' => 'GBP',
        'GF' => 'EUR',
        'GP' => 'EUR',
        'GR' => 'EUR',
        'IE' => 'EUR',
        'IM' => 'GBP',
        'IT' => 'EUR',
        'LT' => 'EUR',
        'LU' => 'EUR',
        'LV' => 'EUR',
        'MC' => 'EUR',
        'ME' => 'EUR',
        'MF' => 'EUR',
        'MQ' => 'EUR',
        'MT' => 'EUR',
        'NL' => 'EUR',
        'PM' => 'EUR',
        'PT' => 'EUR',
        'RE' => 'EUR',
        'RU' => 'USD',
        'SI' => 'EUR',
        'SK' => 'EUR',
        'SM' => 'EUR',
        'TF' => 'EUR',
        'US' => 'USD',
        'VA' => 'EUR',
        'YT' => 'EUR',
    ];

    if (isset($mapCountryCurrency[$country])) {
        return $mapCountryCurrency[$country];
    }

    return 'EUR';
}
