<?php

namespace App\RateServices;

use Log;
use App\RateService;
use GuzzleHttp\Client;

class CoinmarketCap implements RateService
{
    const API_URL = 'https://api.coinmarketcap.com/v1/ticker/viacoin/';

    protected $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetch($currency, $fiat): ?float
    {
        try {
            $response = $this->httpClient->get(
                self::API_URL."?convert={$fiat}"
            );
            $statusCode = $response->getStatusCode();
            $body       = $response->getBody();

            if ($statusCode != 200)
                throw new Exception(
                    "got non 200 statuscode ({$statusCode})"
                );

            $rate = json_decode($body)[0]
                ->{'price_'.strtolower($fiat)};

        } catch (Exception $e) {
            Log::debug(
                "unable to fetch rate for {$fiat}, \"{$e->getMessage()}\""
            );

            $rate = null;
        }

        return $rate;
    }
}
