<?php

namespace App;

interface RateService
{
    public function fetch(string $currency, string $fiat): ?float;
}
