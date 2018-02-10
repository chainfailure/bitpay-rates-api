<?php

namespace App\Http\Controllers;

use App\Repositories\RatesRepository;
use App\Repositories\CurrencyRepository;

class RatesController extends Controller
{
    protected $ratesRepository;
    protected $currencyRepository;

    public function __construct(
        RatesRepository $ratesRepository,
        CurrencyRepository $currencyRepository
    ) {
        $this->ratesRepository = $ratesRepository;
        $this->currencyRepository = $currencyRepository;
    }

    public function index()
    {
        return response()->json(
            $this->ratesRepository->all()->values()
        );
    }
}
