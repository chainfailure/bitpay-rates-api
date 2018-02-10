<?php

use App\Repositories\RatesRepository;
use App\Repositories\CurrencyRepository;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RatesRepositoryTest extends TestCase
{
    /**
     * Can we create an instance of the repository?
     *
     * @test
     */
    public function can_we_create_an_instance()
    {
        $ratesRepository = new RatesRepository(
            new CurrencyRepository
        );

        $this->assertInstanceOf(RatesRepository::class, $ratesRepository);

        return $ratesRepository;
    }

    /**
     * Simple test to check if we can insert and then fetch.
     *
     * @depends can_we_create_an_instance
     * @test
     */
    public function it_persists_values($ratesRepository)
    {
        $code = 'AAA';
        $price = 1.23;
        $ratesRepository->set($code, $price, 60);

        $this->assertEquals($price, $ratesRepository->get($code));

        return $ratesRepository;
    }

    /**
     * Simple test to check if we can insert and then fetch.
     *
     * @depends it_persists_values
     * @test
     */
    public function it_correctly_indicates_existence_of_rate_results($ratesRepository)
    {
        $code = 'AAA';
        $price = 1.23;
        $ratesRepository->set($code, $price, 60);

        $this->assertTrue($ratesRepository->has('AAA'));
        $this->assertFalse($ratesRepository->has('BBB'));
    }
}
