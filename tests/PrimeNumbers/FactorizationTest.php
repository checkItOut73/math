<?php
namespace PrimeNumbers;

use PHPUnit\Framework\TestCase;
use PrimeNumbers\Exceptions\TooFewFactorsException;

class FactorizationTest extends TestCase
{
    public function testGetFactorsReturnsTheGivenFactorsInANormalizedFormat()
    {
        $factorization = new Factorization([1, 2, 5, 2, 3]);

        $this->assertEquals([2, 2, 3, 5], $factorization->getFactors());
    }

    public function testGetProductReturnsTheProductOfTheFactorization()
    {
        $factorization = new Factorization([2, 2, 3, 5]);

        $this->assertEquals(2*2*3*5, $factorization->getProduct());
    }

    public function testIncrementBiggestFactor()
    {
        $factorization = new Factorization([2, 2, 3, 5]);

        $factorization->incrementBiggestFactor();

        $this->assertEquals([2, 2, 3, 6], $factorization->getFactors());
    }

    public function testDecrementBiggestFactor()
    {
        $factorization = new Factorization([2, 2, 3, 5]);

        $factorization->decrementBiggestFactor();

        $this->assertEquals([2, 2, 3, 4], $factorization->getFactors());
    }

    public function testDecrementBiggestFactorPreservesTheOrder()
    {
        $factorization = new Factorization([2, 2, 3, 3]);

        $factorization->decrementBiggestFactor();

        $this->assertEquals([2, 2, 2, 3], $factorization->getFactors());
    }

    public function testDecrementBiggestFactorRemovesMultipleOnes()
    {
        $factorization = new Factorization([1, 2]);

        $factorization->decrementBiggestFactor();

        $this->assertEquals([1], $factorization->getFactors());
    }

    public function testIncrementSecondBiggestFactor()
    {
        $factorization = new Factorization([2, 2, 3, 5]);

        $factorization->incrementSecondBiggestFactor();

        $this->assertEquals([2, 2, 4, 5], $factorization->getFactors());
    }

    public function testIncrementSecondBiggestFactorCreatesAnotherFactorIfThereIsJustOne()
    {
        $factorization = new Factorization([5]);

        $factorization->incrementSecondBiggestFactor();

        $this->assertEquals([2, 5], $factorization->getFactors());
    }

    public function testIncrementSecondBiggestFactorPreservesTheOrder()
    {
        $factorization = new Factorization([2, 2, 3, 3]);

        $factorization->incrementSecondBiggestFactor();

        $this->assertEquals([2, 2, 3, 4], $factorization->getFactors());
    }

    public function testIncrementSecondBiggestFactorCreatesAnotherFactorIfThereIsJustOneAndPreservesTheOrder()
    {
        $factorization = new Factorization([1]);

        $factorization->incrementSecondBiggestFactor();

        $this->assertEquals([1, 2], $factorization->getFactors());
    }

    /**
     * @throws TooFewFactorsException
     */
    public function testDecrementSecondBiggestFactor()
    {
        $factorization = new Factorization([2, 2, 3, 5]);

        $factorization->decrementSecondBiggestFactor();

        $this->assertEquals([2, 2, 2, 5], $factorization->getFactors());
    }

    /**
     * @throws TooFewFactorsException
     */
    public function testDecrementSecondBiggestFactorPreservesTheOrder()
    {
        $factorization = new Factorization([2, 3, 3, 5]);

        $factorization->decrementSecondBiggestFactor();

        $this->assertEquals([2, 2, 3, 5], $factorization->getFactors());
    }

    /**
     * @expectedException \PrimeNumbers\Exceptions\TooFewFactorsException
     * @expectedExceptionMessage Decrement of second biggest factor is not possible because there is just one!
     */
    public function testDecrementSecondBiggestFactorThrowsAnExceptionIfThereIsJustOne()
    {
        $factorization = new Factorization([5]);

        $factorization->decrementSecondBiggestFactor();
    }
}
