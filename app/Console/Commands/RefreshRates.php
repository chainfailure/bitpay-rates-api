<?php

namespace App\Console\Commands;

use Log;
use Exception;
use App\RateService;
use Illuminate\Console\Command;
use App\Repositories\RatesRepository;
use App\Repositories\CurrencyRepository;

class RefreshRates extends Command
{
    protected $signature   = 'rates:refresh';
    protected $description = 'Refresh the conversion rates';

    protected $ratesRepository;
    protected $currencyRepository;
    protected $rateService;

    public function __construct(
        RatesRepository $ratesRepository,
        CurrencyRepository $currencyRepository,
        RateService $rateService
    ) {
        parent::__construct();
        $this->ratesRepository    = $ratesRepository;
        $this->currencyRepository = $currencyRepository;
        $this->rateService        = $rateService;
    }

    public function handle()
    {
        $currencies = $this->currencyRepository->all();
        $bar        = $this->output->createProgressBar(count($currencies));

        foreach ($currencies as $code => $name) {
            $rate = $this->rateService->fetch(
                config('rates.currency'),
                $code
            );

            if (is_null($rate)) {
                $bar->advance();
                continue;
            }

            Log::info("setting rate for {$code} to {$rate}");

            $this->ratesRepository->set(
                $code,
                $rate,
                config('rates.cache_ttl')
            );

            $bar->advance();
        }

        $bar->finish();
    }
}
