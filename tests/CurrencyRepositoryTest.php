<?php

use App\Repositories\RatesRepository;
use App\Repositories\CurrencyRepository;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CurrencyRepositoryTest extends TestCase
{
    /**
     * Can we create an instance of the repository?
     *
     * @test
     */
    public function can_we_create_an_instance()
    {
        $currencyRepository = new CurrencyRepository;

        $this->assertInstanceOf(CurrencyRepository::class, $currencyRepository);

        return $currencyRepository;
    }

    /**
     * Does the repository at least contain USD?
     *
     * @depends can_we_create_an_instance
     * @test
     */
    public function does_the_repository_contain_USD($currencyRepository)
    {
        $this->assertArrayHasKey('USD', $currencyRepository->all());

        return $currencyRepository;
    }

}
