<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use App\Repositories\CurrencyRepository;

class RatesRepository
{
    protected $currencyRepository;

    public function __construct(
        CurrencyRepository $currencyRepository
    ) {
        $this->currencyRepository = $currencyRepository;
    }

    public function set($code, $value, $ttl): void
    {
        Cache::put('rates.'.$code, $value, $ttl);
    }

    public function get($code)
    {
        return Cache::get('rates.'.$code);
    }

    public function has($code)
    {
        return Cache::has('rates.'.$code);
    }

    public function all()
    {
        $currencies = collect($this->currencyRepository->all());

        return $currencies->map(function ($name, $code) {
            return [
                'code' => $code,
                'name' => $name,
                'rate' => $this->has($code) 
                    ? (float) $this->get($code) 
                    : 0
                ,
            ];
        });
    }
}
