<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class CurrencyRepository
{
    protected $currencies = [
        'USD' => 'US Dollar',
        'AUD' => 'Australian Dollar',
        'BRL' => 'Brazilian Real',
        'CAD' => 'Canadian Dollar',
        'CHF' => 'Swiss Franc',
        'CLP' => 'Chilean Peso',
        'CNY' => 'Chinese Yuan',
        'CZK' => 'Czech Koruna',
        'DKK' => 'Danish Krone',
        'EUR' => 'Euro',
        'GBP' => 'Pound Sterling',
        'HKD' => 'Hong Kong Dollar',
        'HUF' => 'Hungarian Forint',
        'IDR' => 'Indonesian Rupiah',
        'ILS' => 'Israeli Shekel',
        'INR' => 'Indian Rupee',
        'JPY' => 'Japanese Yen',
        'KRW' => 'South Korean Won',
        'MXN' => 'Mexican Peso',
        'MYR' => 'Malaysian Ringgit',
        'NOK' => 'Norwegian Krone',
        'NZD' => 'New Zealand Dollar',
        'PHP' => 'Philippine Peso',
        'PKR' => 'Pakistani Rupee',
        'PLN' => 'Polish Zloty',
        'RUB' => 'Russian Ruble',
        'SEK' => 'Swedish Krona',
        'SGD' => 'Singapore Dollar',
        'THB' => 'Thai Baht',
        'TRY' => 'Turkish Lira',
        'TWD' => 'New Taiwan Dollar',
        'ZAR' => 'South African Rand',
    ];

    public function all(): array
    {
        return $this->currencies;
    }

    public function add($code, $name): void
    {
        $this->currencies[$code] = $name;
    }
}
